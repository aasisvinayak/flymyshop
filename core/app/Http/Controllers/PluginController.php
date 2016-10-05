<?php

namespace App\Http\Controllers;

use App\Http\Models\Plugin;
use App\Http\Requests\PluginRequest;
use Flymyshop\Helpers\PluginHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Yaml\Yaml;

/**
 * Class PluginController.
 * @category AppControllers
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class PluginController extends Controller
{
    /**
     * Returns a list of all the plugins in a view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $plugins = Plugin::paginate(10);

        return view('admin/plugins/list', compact('plugins'));
    }

    public function addNewPlugin()
    {
        return view('admin/plugins/add');
    }

    /**
     * Fetch the master.zip from github and add to the plugin directory.
     *
     * @param PluginRequest $request
     * @return Response
     */
    public function processAddPlugin(PluginRequest $request)
    {
        $url = (string) $request->get('url');
        $zipURL = $url.'/archive/master.zip';
        $urlParts = (explode('/', $url));
        $gitName = end($urlParts);
        if (strlen($gitName) < 1) {
            $gitName = $urlParts[count($urlParts) - 2];
        }

        preg_match('/fms_(.*?)_plugin/', $gitName, $pluginName);

        $fmsPluginNameArray = explode('_', $pluginName[1]);
        $fmsPluginName = '';

        foreach ($fmsPluginNameArray as $namePart) {
            $fmsPluginName = $fmsPluginName.ucfirst($namePart);
        }

        if (! $this->checkPluginExists($fmsPluginName)) {
            $destFolder = base_path('flymyshop/plugins/').$fmsPluginName.'/';
            $url = $zipURL;
            $zipFile = base_path('flymyshop/plugins/'.$fmsPluginName.'.zip');

            $contents = file_get_contents($url);
            $bytes_written = File::put($zipFile, $contents);
            if ($bytes_written === false) {
                die('Failed to install. Please check that Flymyshop has write permissions!');
            }

            File::makeDirectory($destFolder);

            $zip = new \ZipArchive;
            if ($zip->open($zipFile) === true) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    $fileinfo = pathinfo($filename);
                    copy('zip://'.$zipFile.'#'.$filename, $destFolder.$fileinfo['basename']);
                }
                $zip->close();

                File::delete($zipFile);

                $ymlContent = File::get($destFolder.'plugin.yml');
                $pluginYaml = Yaml::parse($ymlContent);

                $plugin = Plugin::create(
                    [
                        'name' => $pluginYaml['plugin_name'],
                        'plugin_version' => $pluginYaml['plugin_version'],
                        'plugin_author' => $pluginYaml['plugin_author'],
                        'plugin_support_email' => $pluginYaml['plugin_support_email'],
                        'plugin_description' => $pluginYaml['plugin_description'],
                        'plugin_table' => '',
                        'plugin_config' => '',
                    ]
                );

                $plugin->status = 1;
                $plugin->save();

                $request->session()->flash('alert-success', 'Installed and enabled plugin!');
            } else {
                $request->session()->flash('alert-danger', 'Failed to install. Please check that Flymyshop has write permissions!');
            }
        } else {
            $request->session()->flash('alert-danger', 'You have already installed this plugin!!');
        }

        return redirect('/admin/plugins');
    }

    /**
     * Delete an existing plugin.
     *
     * @param Request $request
     */
    public function deletePlugin(Request $request)
    {
        $plugin = Plugin::findorFail($request->get('id'));
        File::deleteDirectory(base_path('flymyshop/plugins/'.$plugin->name));
        $plugin->delete();
        $request->session()->flash('alert-success', 'Plugin deleted!');

        return redirect('/admin/plugins');
    }

    /**
     * Toggle status of the plugin.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function changePluginStatus(Request $request)
    {
        $plugin = Plugin::findorFail($request->get('id'));
        $plugin->update(
            [
                'status' => (int) $request->get('status'),
            ]
        );

        (int) $request->get('status') == 1 ? $status = 'enabled' : $status = 'disbabled';
        $request->session()->flash('alert-success', 'Plugin status '.$status);

        return redirect('/admin/plugins');
    }

    /**
     * Check plugin is already installed by looking for the directory.
     *
     * @param $name
     * @return bool
     */
    public function checkPluginExists($name)
    {
        $pluginHelper = new PluginHelper();
        $plugins = $pluginHelper->getPluginNames();

        return (in_array($name, $plugins)) ? true : false;
    }

    /**
     * Returns a list of plugins as json response.
     */
    public function pluginList(PluginHelper $pluginBasicHelper)
    {
        return Response::json($pluginBasicHelper->getPluginNames(), 200);
    }
}
