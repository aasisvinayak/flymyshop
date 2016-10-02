<?php

namespace Flymyshop\Helpers;

/**
 * Class ApplicationHelper.
 */
trait ApplicationHelper
{
    /**
      * Save to .env file
      * If new key is supplied it will be appended
      * If existing key is supplied, value will be replaced
      * If the key is not supplied, then the line will be ignored.
      *
      * @param array $shop_config
      * @return bool
      */
     public function save($shop_config = [])
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
