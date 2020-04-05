<?php

namespace Titanium\LaravelApiInterfaceGen;

use Illuminate\Support\ServiceProvider;
use Titanium\LaravelApiInterfaceGen\Console\InstallLaravelApiInterfaceGenPackage;
use Titanium\LaravelApiInterfaceGen\Console\MakeInterface;
use Titanium\LaravelApiInterfaceGen\Console\MakeRepository;
use Titanium\LaravelApiInterfaceGen\Console\MakeRepositoryInterface;

class LaravelApiInterfaceGenServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallLaravelApiInterfaceGenPackage::class,
                MakeInterface::class,
                MakeRepository::class,
                MakeRepositoryInterface::class
            ]);
        }
    }
}
