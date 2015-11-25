<?php

use Bloge\Basic\App;
use Bloge\Basic\Builder;
use Bloge\Basic\Content;
use Bloge\Basic\Renderer;

class BuilderTest extends TestCase
{
    private function builder()
    {
        return new Builder(
            new App(
                new Content(CONTENT_DIR),
                new Renderer(THEME_DIR)
            )
        );
    }
    
    public function testBuild()
    {
        $this->builder()->build(BUILD_DIR);
        $this->assertTrue(
            count(scandir(BUILD_DIR)) > 2, 
            'Builder could not build website!'
        );
    }
    
    /**
     * @expectedException \Bloge\NotWritableException
     */
    public function testNonWritableBuild()
    {
        $this->builder()->build(MAIN_DIR . '/non_writable');
    }
    
    /**
     * @expectedException \Bloge\NotDirectoryException
     */
    public function testNonDirectoryBuild()
    {
        $this->builder()->build(MAIN_DIR . '/content.php');
    }
}