<?php

use Bloge\Apps\BasicApp;
use Bloge\Content\PHP;
use Bloge\Renderers\Renderer;

class AppTest extends TestCase
{
    private function app()
    {
        return new BasicApp(
            new PHP(CONTENT_DIR),
            new Renderer(THEME_DIR)
        );
    }
    
    public function testRender()
    {
        $this->assertEquals(
            "Doge's bloge \nhello \nHello! \nDoge (c) 2015",
            $this->app()->render('index')
        );
    }
}