<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallAdminUserRequest;
use App\Http\Requests\InstallRequest;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/**
 * Class InstallController
 * TODO: flush the echos while processing
 * @package App\Http\Controllers
 * @category AppControllers
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
final class InstallController extends Controller
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
        } catch (\PDOException $e) {
            echo 'Error';
            exit();
        }
    }

    /**
     * Method to install FlyMyShop
     * This method checks that the database config is correct and the install step has
     * not been done previously. It does migrations and seeding of sample data.
     *
     * TODO: make seeding of sample data optional
     *
     * @param InstallAdminUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function process(InstallAdminUserRequest $request)
    {
        if (! Schema::hasTable('users')) {
            echo 'Please wait while we setup the shop ............. <br>';
            Artisan::call('migrate', ['--force' => true]);
            ob_end_flush();
            echo 'Working on the database and adding admin user ...... <br>';
            ob_start();
            Artisan::call('db:seed', ['--force' => true]);
            echo 'Working on it ...... <br>';

            $user = User::findorFail(1);// getting the admin user TODO: allow admin user to change
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


    /**
     * Save DB details to .env file
     * //TODO: change to database or config file
     *
     * @param InstallRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function installShop(InstallRequest $request)
    {
        echo 'Setting up database<br>';// TODO: flush the echos while processing

        $shopName = preg_replace('/\s+/', '_', $request->get('SHOP_NAME'));
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

    /**
     * Checks if the application has already been installed and then allows the user
     * to enter database config details
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Save to .env file
     * If new key is supplied it will be appended
     * If existing key is supplied, value will be replaced
     * If the key is not supplied, then the line will be ignored
     *
     * @param array $shop_config
     * @return bool
     */
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
            //TODO: Check the efficiency and correspondingly check whether
            //  Laravel helper should be used
            file_put_contents(base_path('.env'), $env."\n".$envAdditional);
            return true;
        } else {
            return false;
        }
    }
}
