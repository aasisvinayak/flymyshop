<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

/**
 * Class Controller
 *
 * @category Laravel
 *
 * @package App\Http\Controllers
 *
 * @author Laravel <laravel@laravel.com>
 *
 * @license https://github.com/laravel/laravel/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/laravel/laravel
 */
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
}
