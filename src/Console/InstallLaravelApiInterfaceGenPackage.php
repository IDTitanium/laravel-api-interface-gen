<?php

namespace Titanium\LaravelApiInterfaceGen\Console;

use Illuminate\Console\Command;

class InstallLaravelApiInterfaceGenPackage extends Command
{
    protected $hidden = true;

    protected $signature = 'install:laravelinterfacegen';

    protected $description = 'Install the Laravel Api Interface Gen Package';

    public function handle()
    {
        $this->info('Installing LaravelApiInterfaceGen...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Titanium\LaravelApiInterfaceGen\LaravelApiInterfaceGenServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed LaravelApiInterfaceGen');
    }
}
