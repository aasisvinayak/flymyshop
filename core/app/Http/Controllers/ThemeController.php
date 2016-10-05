<?php

namespace App\Http\Controllers;
use App\Http\Models\Theme;
use Flymyshop\Helpers\ApplicationHelper;
use Flymyshop\Helpers\ThemeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ThemeController.
 * @category AppControllers
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class ThemeController extends Controller
{

    use ApplicationHelper;

    /**
     * List of themes.
     *
     * @return mixed
     */
    public function index()
    {
        $themes = Theme::paginate(10);
        return view('admin/themes/list', compact('themes'));
    }

    /**
     * Form to add a new theme.
     *
     * @return mixed
     */
    public function addNewTheme()
    {
        return view('admin/themes/add');
    }

    /**
     *
     * //TODO: reuse code
     *
     * @param Request $request
     */
    public function processAddTheme(Request $request)
    {
        $url = (string)$request->get('url');
        $zipURL = $url . "/archive/master.zip";
        $urlParts = (explode('/', $url));
        $gitName = end($urlParts);
        if (strlen($gitName) < 1) {
            $gitName = $urlParts[count($urlParts) - 2];
        }

        preg_match('/fms_(.*?)_theme/', $gitName, $pluginName);

        $fmsThemeNameArray = explode('_', $pluginName[1]);
        $fmsThemeName = "";

        foreach ($fmsThemeNameArray as $namePart) {
            $fmsThemeName = $fmsThemeName . ucfirst($namePart);
        }

        if (!$this->checkThemeExists($fmsThemeName)) {

            $destFolder = public_path('themes/') . $fmsThemeName . "/";
            $url = $zipURL;
            $zipFile = public_path('themes/' . $fmsThemeName . '.zip');

            $contents = file_get_contents($url);
            $bytes_written = File::put($zipFile, $contents);
            if ($bytes_written === false)
            {
                die("Failed to install. Please check that FlyMyShop has write permissions!");
            }

            File::makeDirectory($destFolder);

            $zip = new \ZipArchive;
            if ($zip->open($zipFile) === TRUE) {

                $zip->extractTo(public_path('themes/'));
                $unzipDirName= trim($zip->getNameIndex(0), '/');
                $zip->close();
                File::copyDirectory(public_path('themes/').$unzipDirName, $destFolder);
                File::deleteDirectory(public_path('themes/').$unzipDirName);
                File::delete($zipFile);

                $ymlContent=File::get($destFolder."/theme.yaml");
                $pluginYaml= Yaml::parse($ymlContent);

                $theme=  Theme::create(
                    array(
                        'name' => $pluginYaml['theme_name'],
                        'theme_version' => $pluginYaml['theme_version'],
                        'theme_author' => $pluginYaml['theme_description'],
                        'theme_description' => $pluginYaml['theme_author'],
                    )
                );

                $theme->status = 0;
                $theme->save();
                $request->session()->flash('alert-success', 'Theme installed successfully!');

                return redirect('/admin/themes');

            } else {
                $request->session()->flash('alert-danger', 'Failed to install. Please check that FlyMyShop has write permissions!');
            }


        } else {
            $request->session()->flash('alert-danger', 'You have already installed this theme!');
        }
    }


    /**
     * Delete an existing theme
     * DB entry and files are deleted
     *
     * @param Request $request
     * @return mixed
     */
    public function deleteTheme(Request $request)
    {
        $theme = Theme::findorFail($request->get('id'));
        File::deleteDirectory(public_path('themes/' . $theme->name));
        $theme->delete();
        $request->session()->flash('alert-success', 'Theme deleted!');

        return redirect('/admin/themes');
    }

    /**
     * Check whether the theme exists by scanning the theme folder.
     *
     * @param $name
     * @return bool
     */
    public function checkThemeExists($name)
    {
        $themeHelper = new ThemeHelper();
        $themes = $themeHelper->getThemes();
        return (in_array($name, $themes)) ? true : false;

    }
}
