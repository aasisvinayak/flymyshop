<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class CreateTheme
 * Class for adding artisan command make:theme to create a new theme
 *
 * @package App\Console\Commands
 */
class CreateTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:theme {name : Name of the theme that you want to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create boiler plates for Flymyshop theme';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $themeName = $this->argument('name');
        if (! $this->files->isDirectory(base_path().'/../public/themes/'.$themeName)) {
            $files = $this->files->allFiles(base_path().'/../public/themes/default');

            $this->files->makeDirectory(base_path().'/../public/themes/'.$themeName);

            $directories = ['account', 'auth', 'emails', 'errors', 'includes',
                'layouts', 'pages', 'partials', 'payment', 'shop',
                'account/address', 'account/payment', 'account/profile',
                'auth/emails', 'auth/passwords',
            ];

            foreach ($directories as $directory) {
                $this->files->makeDirectory(base_path().'/../public/themes/'.$themeName.'/'.$directory);
            }

            foreach ($files as $item) {
                $item = str_replace(base_path().'/../public/themes/default/', '', $item);
                $this->files->put(base_path().'/../public/themes/'.$themeName.'/'.$item, '');
            }

            $this->info($themeName.'  created in themes folder');
        } else {
            $this->error($themeName.' theme already exists!');
        }
    }
}
