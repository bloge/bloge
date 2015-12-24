<?php

namespace Bloge\Apps;

use Bloge\Content\IAdvanced;
use Bloge\IPlugin;
use Bloge\Renderers\IRenderer;

class AdvancedApp extends BasicApp implements IPluggableApp
{
    /**
     * @param \Bloge\Content\IAdvanced $content
     * @param \Bloge\Renderers\IRenderer $renderer
     */
    public function __construct(
        IAdvanced $content, 
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