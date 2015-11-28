<?php

namespace Bloge\Compilers;

use Bloge\Apps\BasicApp;
use Bloge\Content\PHP as Content;
use Bloge\Renderers\PHP as Renderer;

class HTMLCompilerTest extends \TestCase
{
    private function compiler()
    {
        return new HTMLCompiler(
            new BasicApp(
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