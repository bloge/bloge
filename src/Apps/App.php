<?php

namespace Bloge\Apps;

use Bloge\PluggableApp;
use Bloge\Plugin;

class App extends BasicApp implements PluggableApp
{
    /**
     * @param \Bloge\Content\Advanced $content
     * @param \Bloge\Renderer $renderer
     */
    public function __construct(
        \Bloge\Content\Advanced $content, 
        \Bloge\Renderer $renderer
    ) {
        $this->content  = $content;
        $this->renderer = $renderer;
    }
    
    /**
     * @{inheritDoc}
     */
    public function content()
    {
        return $this->content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function plugin(Plugin $plugin) 
    {
        $plugin->register($this);
        
        return $this;
    }
}