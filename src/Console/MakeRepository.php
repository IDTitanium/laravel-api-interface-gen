<?php

namespace Titanium\LaravelApiInterfaceGen\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class MakeRepository extends GeneratorCommand
{
    protected $name = 'make:repository';

    protected $description = 'Create a new repository class';

    protected $type = 'Repository';

    protected function getStub()
    {
        return __DIR__ . '/stubs/ModelRepository.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }

    protected function getInterfaceNamespace()
    {
        $rootNamespace = $this->rootNamespace();
        return $rootNamespace . 'Repositories\Interfaces';
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
        $nameInput = $this->getNameInput() . 'Repository';
        $class = $this->qualifyClass($nameInput);
        $interfaceName = $class . 'Interface';

        if (!$interfaceName) {
            return $this->error('interfacename is not provided');
        }

        $path = $this->getPath($class);

        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())
        ) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass2($class, $interfaceName)));

        $this->info($this->type . ' created successfully.');
    }

    protected function buildClass2($class, $interfaceName)
    {
        $stub = $this->files->get($this->getStub());

        $stub = $this->replaceNamespace($stub, $class)->replaceClass($stub, $class);
        $stub = $this->replaceInterface($stub, $interfaceName);
        $stub = $this->replaceInterfaceNamespace($stub, $interfaceName);
        return $stub;
    }

    protected function replaceInterface($stub, $interfaceName)
    {
        $class = str_replace($this->getNamespace($interfaceName) . '\\', '', $interfaceName);
        return str_replace(['DummyInterface', '{{ interface }}', '{{interface}}'], $class, $stub);
    }

    protected function replaceInterfaceNamespace($stub, $interfaceName)
    {
        $interfaceNameSpace = $this->getInterfaceNamespace();
        $class = str_replace($this->getNamespace($interfaceName) . '\\', '', $interfaceName);
        $stub = str_replace(['DummyForInterfaceNameSpace'], $interfaceNameSpace . '\\' . $class, $stub);
        return $stub;
    }
}
