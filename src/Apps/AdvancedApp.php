<?php

namespace Bloge\Apps;

use Bloge\Content\Advanced;
use Bloge\IPlugin;
use Bloge\Renderers\IRenderer;

class AdvancedApp extends BasicApp implements IPluggableApp
{
    /**
     * @param \Bloge\Content\Advanced $content
     * @param \Bloge\Renderer $renderer
     */
    public function __construct(
        Advanced $content, 
        IRenderer $renderer
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
    public function plugin(IPlugin $plugin) 
    {
        $plugin->register($this);
        
        return $this;
    }
}