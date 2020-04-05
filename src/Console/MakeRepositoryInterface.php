<?php

namespace Titanium\LaravelApiInterfaceGen\Console;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;

class MakeRepositoryInterface extends GeneratorCommand
{
    protected $name = 'make:repositoryinterface {name}';

    protected $description = 'Create a new repository class and its corresponding interface';

    protected $type = '';

    protected function getStub()
    {
        return __DIR__;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    public function handle()
    {
        if (!$this->argument('name')) {
            return $this->error('The name argument is required');
        }
        $this->info('Making Interface...');
        Artisan::call('make:interface', ['name' => $this->argument('name')]);
        $this->info('Made Interface');
        $this->info('Making Repository...');
        Artisan::call('make:repository', ['name' => $this->argument('name')]);
        $this->info('Made Repository');
    }
}
