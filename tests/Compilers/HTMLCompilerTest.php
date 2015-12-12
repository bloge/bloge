<?php

namespace Bloge\Compilers;

use Bloge\Apps\BasicApp;
use Bloge\Content\PHP as Content;
use Bloge\Renderers\PHP as Renderer;

class HTMLCompilerTest extends \TestCase
{
    private function app()
    {
        return new BasicApp(
            new Content(CONTENT_DIR),
            new Renderer(THEME_DIR)
        );
    }
    
    private function compiler()
    {
        return new HTMLCompiler($this->app());
    }
    
    public function testBuild()
    {
        foreach ($this->app()->browse() as $path) {
            $this->compiler()->build($path, BUILD_DIR);
        }
        
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
        $this->compiler()->isBuildable(MAIN_DIR . '/non_writable');
    }
    
    /**
     * @expectedException \Bloge\NotDirectoryException
     */
    public function testNonDirectoryBuild()
    {
        $this->compiler()->isBuildable(MAIN_DIR . '/content.php');
    }
}