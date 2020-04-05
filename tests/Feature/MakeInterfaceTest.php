<?php

use Illuminate\Support\Facades\File;
use Titanium\LaravelApiInterfaceGen\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class MakeInterfaceTest extends TestCase
{
    /** @test */
    function it_creates_a_new_interface_class()
    {
        // destination path of the Foo class
        $interfaceClass = app_path('Repositories/Interfaces/BookRepositoryInterface.php');

        // make sure we're starting from a clean state
        if (File::exists($interfaceClass)) {
            unlink($interfaceClass);
        }

        $this->assertFalse(File::exists($interfaceClass));

        // Run the make command
        Artisan::call('make:interface Book');

        // Assert a new file is created
        $this->assertTrue(File::exists($interfaceClass));

        // Assert the file contains the right contents
        $expectedContents = <<<CLASS
<?php

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface
{
    //
}
CLASS;

        $this->assertEquals($expectedContents, file_get_contents($interfaceClass));
    }
}
