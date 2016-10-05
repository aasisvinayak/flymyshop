<?php

namespace  App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Plugin.
 */
class Plugin extends Model
{
    protected $fillable = [
        'name',
        'plugin_version',
        'plugin_author',
        'plugin_support_email',
        'plugin_description',
        'plugin_table',
        'plugin_config',
        'status',
    ];
}
