<?php

namespace Titanium\LaravelApiInterfaceGen\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MakeInterface extends GeneratorCommand
{
    protected $name = 'make:interface';

    protected $description = 'Create a new interface class';

    protected $type = 'Interface';

    protected function getStub()
    {
        return __DIR__ . '/stubs/ModelRepositoryInterface.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\Interfaces';
    }

    public function handle()
    {
        $this->createTheFile();
        $serviceProviderPath = app_path('Providers/RepositoryServiceProvider');
        if (!File::exists($serviceProviderPath)) {
            Artisan::call('make:provider RepositoryServiceProvider');
        }
    }

    protected function createTheFile()
    {
        $nameInput = $this->getNameInput() . 'RepositoryInterface';
        $class = $this->qualifyClass($nameInput);

        $path = $this->getPath($class);

        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($nameInput)
        ) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($class)));

        $this->info($this->type . ' created successfully.');
    }
}
