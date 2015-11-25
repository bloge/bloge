<?php

use Bloge\Basic\App;
use Bloge\Basic\Compiler;
use Bloge\Basic\Content;
use Bloge\Basic\Renderer;

class CompilerTest extends TestCase
{
    private function compiler()
    {
        return new Compiler(
            new App(
                new Content(CONTENT_DIR),
                new Renderer(THEME_DIR)
            )
        );
    }
    
    public function testBuild()
    {
        $this->compiler()->build(BUILD_DIR);
        $this->assertTrue(
            count(scandir(BUILD_DIR)) > 2, 
            'Compiler could not build website!'
        );
    }
    
    /**
     * @expectedException \Bloge\NotWritableException
     */
    public function testNonWritableBuild()
    {
        $this->compiler()->build(MAIN_DIR . '/non_writable');
    }
    
    /**
     * @expectedException \Bloge\NotDirectoryException
     */
    public function testNonDirectoryBuild()
    {
        $this->compiler()->build(MAIN_DIR . '/content.php');
    }
}