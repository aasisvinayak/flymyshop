<?php

namespace App\Http\Controllers;
use Flymyshop\Helpers\ApplicationHelper;
use Flymyshop\Helpers\ThemeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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


    public function index()
    {

        return view('admin/themes/list');
    }
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

            } else {
                echo 'Failed to install. Please check that FlyMyShop has write permissions!';
            }


        } else {
            echo "You have already installed this theme!";
        }
    }

    public function enableTheme()
    {
    }

    public function disableTheme()
    {
    }

    public function deleteTheme()
    {
    }

    public function themes()
    {
    }

    public function checkThemeExists($name)
    {
        $themeHelper = new ThemeHelper();
        $themes = $themeHelper->getThemes();
        return (in_array($name, $themes)) ? true : false;

    }
}
