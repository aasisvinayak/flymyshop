<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallAdminUserRequest;
use App\Http\Requests\InstallRequest;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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
                return view('install/install');
            }
        } catch (PDOException $e) {
            echo 'Error';
            exit();
        }
    }

    public function process(InstallAdminUserRequest $request)
    {
        if (! Schema::hasTable('users')) {
            echo 'Please wait while we setup the shop ............. <br>';
            Artisan::call('migrate', array('--force' => true));
            ob_end_flush();
            echo 'Working on the database and adding admin user ...... <br>';
            ob_start();
            Artisan::call('db:seed', array('--force' => true));
            echo 'Working on it ...... <br>';

            $user = User::findorFail(1);
            $user->update(
                [
                    'email' => $request->get('admin_user'),
                    'password' => Hash::make($request->get('admin_password')),
                ]
            );
        } else {
            echo 'You can already installed FlyMyShop!';
            exit();
        }

        return redirect('/');
    }

    public function installShop(InstallRequest $request)
    {
        echo 'Setting up database<br>';

        $shopName=preg_replace('/\s+/', '_', $request->get('SHOP_NAME'));
        $env_update = $this->save([
            'DB_PASSWORD' => $request->get('DB_PASSWORD'),
            'DB_USERNAME' => $request->get('DB_USERNAME'),
            'DB_PORT' => $request->get('DB_PORT'),
            'DB_HOST' => $request->get('DB_HOST'),
            'DB_DATABASE' => $request->get('DB_DATABASE'),
            'SHOP_NAME' => $shopName,
        ]);
        if ($env_update) {
            return redirect('install/step-2');
        } else {
            echo 'Error occurred! Please make sure that .env file is writable';
        }
    }

    public function postInstall()
    {
        try {
            if (! is_null((DB::connection()->getDatabaseName()))) {
                if (Schema::hasTable('users')) {
                    exit('You have setup FlyMyShop already!');
                } else {
                    return view('install/admin-setup');
                }
            } else {
            }
        } catch (PDOException $e) {
            echo 'Error';
            exit();
        }
    }

    protected function save($shop_config = [])
    {
        if (! is_null($shop_config)) {
            $env = preg_split('/\s+/', file_get_contents(base_path('.env')));
            foreach ($shop_config as $key => $value) {
                $found = false;
                foreach ($env as $env_key => $env_value) {
                    $entry = explode('=', $env_value);
                    if ($entry[0] == $key) {
                        $env[$env_key] = $key.'='.$value;
                        $found = true;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }

                if ($found) {
                    unset($shop_config[$key]);
                }
            }

            $newValues = [];
            foreach ($shop_config as $key => $value) {
                $new = $key.'='.$value;
                array_push($newValues, $new);
            }

            $env = implode("\n", $env);
            $envAdditional = implode("\n", $newValues);
            file_put_contents(base_path('.env'), $env."\n".$envAdditional);

            return true;
        } else {
            return false;
        }
    }
}
