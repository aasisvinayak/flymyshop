<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreatePlugin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:plugin {name : Name of the plugin that you want to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create boiler plates for Flymyshop plugins';

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
        $pluginName = $this->argument('name');

        //TODO: catch errors

        //TODO: check code works without DIRECTORY_SEPARATOR

        if (! $this->files->isDirectory(base_path().'/flymyshop/plugins/'.$pluginName)) {
            $this->files->makeDirectory((base_path().'/flymyshop/plugins/'.$pluginName), 0777, true, true);
            $stubs = $this->getStubs();
            $pluginStub = $this->getPluginStub();
            foreach ($stubs as $key => $value) {
                $key = str_replace('plugin-', '', $key);
                if ($key == 'yml') {
                    $key = 'plugin';
                    $this->files->put(base_path().'/flymyshop/plugins/'.$pluginName.'/'.$key.'.yml', $value);
                } else {
                    $this->files->put(base_path().'/flymyshop/plugins/'.$pluginName.'/'.$key.'.php', $value);
                }
            }
            $this->files->put(base_path().'/flymyshop/plugins/'.$pluginName.'/'.$pluginName.'.php', $this->buildPluginClass($pluginName, $pluginStub));

            $this->info($pluginName.' created in flymyshop/plugins folder');
        } else {
            $this->error($pluginName.' Plugin already exists!');
        }
    }

    public function getPluginStub()
    {
        return
            $this->files->get(base_path().'/flymyshop/stubs/plugin.stub');
    }

    protected function getStubs()
    {
        return [
            'plugin-config' => $this->files->get(base_path().'/flymyshop/stubs/plugin-config.stub'),
            'plugin-index' => $this->files->get(base_path().'/flymyshop/stubs/plugin-index.stub'),
            'plugin-install' => $this->files->get(base_path().'/flymyshop/stubs/plugin-install.stub'),
            'plugin-yml' => $this->files->get(base_path().'/flymyshop/stubs/plugin-yml.stub'),
        ];
    }

    protected function buildPluginClass($name, $stub)
    {
        $stub = str_replace(
            'PluginName', $name, $stub
        );

        return $stub;
    }
}
