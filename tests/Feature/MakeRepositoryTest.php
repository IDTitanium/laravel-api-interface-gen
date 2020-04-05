<?php

use Illuminate\Support\Facades\File;
use Titanium\LaravelApiInterfaceGen\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class MakeRepositoryTest extends TestCase
{
    /** @test */
    function it_creates_a_new_repository_class()
    {
        // destination path of the Foo class
        $repoClass = app_path('Repositories/BookRepository.php');

        // make sure we're starting from a clean state
        if (File::exists($repoClass)) {
            unlink($repoClass);
        }

        $this->assertFalse(File::exists($repoClass));

        // Run the make command
        Artisan::call('make:repository Book');

        // Assert a new file is created
        $this->assertTrue(File::exists($repoClass));

        // Assert the file contains the right contents
        $expectedContents = <<<CLASS
<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    //
}
CLASS;

        $this->assertEquals($expectedContents, file_get_contents($repoClass));
    }
}
