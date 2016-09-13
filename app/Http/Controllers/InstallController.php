<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    /**
     * TODO: Display form to save to .env.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            if (! is_null((DB::connection()->getDatabaseName()))) {
                return redirect('/');
            } else {
                echo 'Welcome to FlyMyCloud Installation Wizard'.'<br>';
                echo 'Please update your .env to get started!';
            }
        } catch (PDOException $e) {
            echo 'Error';
            exit();
        }
    }

    public function save()
    {
    }
}
