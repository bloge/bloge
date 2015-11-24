<?php

use Bloge\Basic\App;
use Bloge\Basic\Builder;
use Bloge\Basic\Content;
use Bloge\Basic\Creator;
use Bloge\Basic\Theme;

class BuilderTest extends TestCase
{
    private function builder()
    {
        return new Builder(
            new App(
                new Creator(new Content(CONTENT_DIR)),
                new Theme(THEME_DIR)
            )
        );
    }
    
    public function testBuild()
    {
        $this->builder()->build(BUILD_DIR);
        $this->assertTrue(
            count(scandir(BUILD_DIR)) > 2, 
            'App could not build website!'
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