<?php

namespace  App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Theme
 * @package App\Http\Models
 */
class Theme extends Model
{
    protected $fillable= [
        'name',
        'theme_version',
        'theme_description',
        'theme_author',
        'status'
    ];
}
