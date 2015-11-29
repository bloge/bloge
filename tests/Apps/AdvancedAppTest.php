<?php

namespace Bloge\Apps;

use Bloge\Content\Advanced;
use Bloge\Content\PHP as Content;
use Bloge\Renderers\PHP as Renderer;

class SimplePlugin implements \Bloge\IPlugin
{
    public function register(IPluggableApp $app)
    {
        $app->content()
            ->dispatcher()
            ->map('index', 'welcome');
    }
}

class AdvancedAppTest extends \TestCase
{
    private function app()
    {
        return new AdvancedApp(
            new Advanced(new Content(CONTENT_DIR)),
            new Renderer(THEME_DIR)
        );
    }
    
    public function testRender()
    {
        $app = $this->app();
        
        $app->content()
            ->dispatcher()
            ->map('index', 'welcome');
        
        $this->assertEquals(
            "Doge's bloge \nhello \nHello! \nDoge (c) 2015",
            $app->render('welcome')
        );
    }
    
    public function testPlugin()
    {
        $app = $this->app()->plugin(new SimplePlugin);
        
        $this->assertEquals(
            "Doge's bloge \nhello \nHello! \nDoge (c) 2015",
            $app->render('welcome')
        );
    }
}