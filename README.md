# laravel-api-interface-gen
Provides useful artisan command to help generate repositories and interfaces.

## USAGE

1. Making an Interface
When you run `php artisan make:interface Book`. This will generate two folders (if they don't already exist). One called Repositories and inside it Interfaces. Then, the `BookRepostoryInterface` will be created inside the Interfaces folder.

2. Making a Repository
when you run `php artisan make:repository Book`. This will generate a repository class with the Name `BookRepository`
With an assumption that you already have an interface called `BookRepositoryInterface`.

3. Making a Repsoitory and Interface.
This is the best part of this package. when you run `php artisan make:repositoryinterface Book`. This creates both the repository and the interface in their respective folders and correct namespaces.

#### NOTE: This commands currently does not register the service provider in the app config. Also, it creates a service provider wihout the binding of the repository to the interface.
