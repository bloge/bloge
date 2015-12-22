<?php

namespace Bloge\CLI;

class CLITest extends \TestCase
{
    public function testBuild()
    {
        $result = exec(
            './bin/bloge ' . 
            './tests/resources/app.php '.
            './tests/resources/build'
        );
        
        $this->assertEquals(
            "Application './tests/resources/app.php' was successfully compiled " .
            "into './tests/resources/build'!", 
            $result
        );
    }
}