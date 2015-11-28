<?php

namespace Bloge\Apps;

use Bloge\Content\PHP as Content;
use Bloge\Renderers\PHP as Renderer;

class AppTest extends \TestCase
{
    private function app()
    {
        return new BasicApp(
            new Content(CONTENT_DIR),
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