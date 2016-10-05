<?php

namespace Flymyshop\Helpers;

use Illuminate\Support\Facades\File;

/**
 * Theme PluginHelper.
 *
 * Helper class for themes and controllers.
 */
class ThemeHelper
{
    /**
     * Return array of Fms themes by scanning the themes directory.
     *
     * @return array
     */
    public function getThemes()
    {
        $themeList = File::directories(public_path('/themes/'));
        $themes = [];

        foreach ($themeList as $theme) {
            array_push($themes, ucfirst(basename($theme)));
        }

        return $themes;
    }
}
