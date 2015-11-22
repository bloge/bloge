<?php

use Bloge\Basic\App;
use Bloge\Basic\Content;
use Bloge\Basic\Theme;

class AppTest extends TestCase
{
    private function createApp()
    {
        return new App(
            new Content(CONTENT_DIR),
            new Theme(THEME_DIR)
        );
    }
    
    public function testRender()
    {
        $this->assertEquals(
            "Doge's bloge \nhello \nHello! \nDoge (c) 2015",
            $this->createApp()->render('index.php')
        );
    }
    
    public function testBuild()
    {
        $this->createApp()->build(BUILD_DIR);
        $this->assertTrue(
            count(scandir(BUILD_DIR)) > 2, 
            'App could not build website!'
        );
    }
}