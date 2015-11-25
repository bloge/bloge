<?php

use Bloge\Basic\App;
use Bloge\Basic\Content;
use Bloge\Basic\Renderer;

class AppTest extends TestCase
{
    private function createApp()
    {
        return new App(
            new Content(CONTENT_DIR),
            new Renderer(THEME_DIR)
        );
    }
    
    public function testRender()
    {
        $this->assertEquals(
            "Doge's bloge \nhello \nHello! \nDoge (c) 2015",
            $this->createApp()->render('index.php')
        );
    }
}