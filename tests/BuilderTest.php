<?php

use Bloge\Basic\App;
use Bloge\Basic\Builder;
use Bloge\Basic\Content;
use Bloge\Basic\Creator;
use Bloge\Basic\Theme;

class BuilderTest extends TestCase
{
    private function createApp()
    {
        return new App(
            new Creator(new Content(CONTENT_DIR)),
            new Theme(THEME_DIR)
        );
    }
    
    public function testBuild()
    {
        $builder = new Builder($this->createApp());
        $builder->build(BUILD_DIR);
        
        $this->assertTrue(
            count(scandir(BUILD_DIR)) > 2, 
            'App could not build website!'
        );
    }
}