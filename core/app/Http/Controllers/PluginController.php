<?php

namespace App\Http\Controllers;

use App\Http\Requests\PluginRequest;
use Flymyshop\Helpers\PluginHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
        return view('admin/plugins/list');
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
        $url = (string)$request->get('url');
        $zipURL = $url . "/archive/master.zip";
        $urlParts = (explode('/', $url));
        $gitName = end($urlParts);
        if (strlen($gitName) < 1) {
            $gitName = $urlParts[count($urlParts) - 2];
        }

        preg_match('/fms_(.*?)_plugin/', $gitName, $pluginName);

        $fmsPluginNameArray = explode('_', $pluginName[1]);
        $fmsPluginName = "";

        foreach ($fmsPluginNameArray as $namePart) {
            $fmsPluginName = $fmsPluginName . ucfirst($namePart);
        }

        if (!$this->checkPluginExists($fmsPluginName)) {

            $destFolder = base_path('flymyshop/plugins/') . $fmsPluginName . "/";
            $url = $zipURL;
            $zipFile = base_path('flymyshop/plugins/' . $fmsPluginName . '.zip');

            $contents = file_get_contents($url);
            $bytes_written = File::put($zipFile, $contents);
            if ($bytes_written === false)
            {
                die("Failed to install. Please check that Flymyshop has write permissions!");
            }

            File::makeDirectory($destFolder);

            $zip = new \ZipArchive;
            if ($zip->open($zipFile) === TRUE) {
                for($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    $fileinfo = pathinfo($filename);
                    copy("zip://".$zipFile."#".$filename, $destFolder.$fileinfo['basename']);
                }
                $zip->close();

                File::delete($zipFile);

            } else {
                echo 'Failed to install. Please check that Flymyshop has write permissions!';
            }


        } else {
            echo "You have already installed this plugin!";
        }

    }

    /**
     * Delete an existing plugin
     *
     * @param Request $request
     */
    public function deletePlugin(Request $request)
    {
        $pluginName=$request->get('name');
        File::deleteDirectory(base_path('flymyshop/plugins/'.$pluginName));
    }

    public function enablePlugin()
    {
    }

    public function disablePlugin()
    {
    }


    /**
     * Check plugin is already installed by looking for the directory
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
