<?php

namespace App\Http\Controllers;

use Flymyshop\Helpers\PluginHelper;
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

    /**
     * TODO.
     */
    public function addNewPlugin()
    {
    }

    /**
     * TODO.
     */
    public function deletePlugin()
    {
    }

    /**
     * Returns a list of plugins as json response.
     */
    public function pluginList(PluginHelper $pluginBasicHelper)
    {
        return Response::json($pluginBasicHelper->getPluginNames(), 200);
    }
}
