<?php

use Bloge\Apps\App;
use Bloge\Compilers\HTMLCompiler;
use Bloge\Content\BasicContent;
use Bloge\Renderers\Renderer;

class CompilerTest extends TestCase
{
    private function compiler()
    {
        return new HTMLCompiler(
            new App(
                new BasicContent(CONTENT_DIR),
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