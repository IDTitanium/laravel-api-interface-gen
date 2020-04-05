<?php

namespace Titanium\LaravelApiInterfaceGen\Tests;

use Titanium\LaravelApiInterfaceGen\LaravelApiInterfaceGenServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelApiInterfaceGenServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        //
    }
}
