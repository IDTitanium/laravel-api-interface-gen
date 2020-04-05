<?php

namespace Titanium\LaravelApiInterfaceGen\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Titanium\LaravelApiInterfaceGen\Tests\TestCase;

class InstallLaravelApiInterfaceGenTest extends TestCase
{
    /**@test */
    function install_command_creates_config_file()
    {
        if (File::exists(config_path('laravelapiinterfacegen.php'))) {
            unlink(config_path('laravelapiinterfacegen.php'));
        }

        $this->assertFalse(File::exists(config_path('laravelapiinterfacegen.php')));

        Artisan::call('install:laravelinterfacegen');

        $this->assertTrue(File::exists(config_path('laravelapiinterfacegen.php')));
    }
}
