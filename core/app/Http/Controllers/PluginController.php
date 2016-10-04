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
     * @param Request $request
     * @return Response
     */
    public function processAddPlugin(Request $request)
    {
        $url = (string)$request->get('url');
        $zipURL = $url . "/archive/master.zip";
        $urlParts = (explode('/', $url));
        $gitName = end($urlParts);
        if (strlen($gitName) < 1) {
            $gitName = $urlParts[count($urlParts) - 2];
        }
        $pluginName = str_replace('fms_', '', $gitName);
        $pluginName = str_replace('_plugin', '', $pluginName);
        $fmsPluginNameArray = explode('_', $pluginName);
        $fmsPluginName = "";

        foreach ($fmsPluginNameArray as $namePart) {
            $fmsPluginName = $fmsPluginName . ucfirst($namePart);
        }


        if (!$this->checkPluginExists($fmsPluginName)) {

            $destFolder = base_path('flymyshop/plugins/') . $fmsPluginName . "/";
            $url = $zipURL;
            $zipFile = base_path('flymyshop/plugins/' . $fmsPluginName . '.zip');

            fopen($zipFile, "w");
            $gitZipfile = fopen($url, "rb");

            if ($gitZipfile) {
                $pluginZip = fopen($zipFile, "a");

                if ($pluginZip)
                    while (!feof($gitZipfile)) {
                        fwrite($pluginZip, fread($gitZipfile, 1024 * 8), 1024 * 8);
                    }
            }

            if ($gitZipfile) {
                fclose($gitZipfile);
            }

            if ($pluginZip) {
                fclose($pluginZip);
            }


//            $zip = zip_open($zipFile);
//            if ($zip) {
//                while ($zip_entry = zip_read($zip)) {
//                    $fp = fopen($destFolder, "w");
//                    if (zip_entry_open($zip, $zip_entry, "r")) {
//                        $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
//                        fwrite($fp, "$buf");
//                        zip_entry_close($zip_entry);
//                        fclose($fp);
//                    }
//                }
//                zip_close($zip);
//            }

//            $zip = new \ZipArchive;
//
//            File::makeDirectory($destFolder);
//
//            if ($zip->open($zipFile, \ZipArchive::CREATE) === TRUE) {
//                $zip->extractTo($destFolder);
//                $zip->close();
//                echo $fmsPluginName. ' Plugin installed';
//                File::delete($zipFile);
//            } else {
//                echo 'Failed to unzip! Please check Flymyshop has write permissions';
//            }


        } else {
            echo "You have already installed this plugin!";
        }

    }

    public function deletePlugin()
    {
    }

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
