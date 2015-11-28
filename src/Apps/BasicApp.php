<?php

namespace Bloge\Apps;

use Bloge\Content\IContent;
use Bloge\Renderers\IRenderer;

/**
 * Basic application
 * 
 * An application without any tweaks. No configuration, easy, simple, fast, and 
 * works straight out of box
 * 
 * @package Bloge
 */
class BasicApp implements IApp
{
    /**
     * @var \Bloge\Content\Content $content
     */
    protected $content;
    
    /**
     * @var \Bloge\Renderers\Renderer $renderer
     */
    protected $renderer;
    
    /**
     * @param \Bloge\Content\Content $content
     * @param \Bloge\Renderers\Renderer $renderer
     */
    public function __construct(
        IContent $content, 
        IRenderer $renderer
    ) {
        $this->content = $content;
        $this->renderer = $renderer;
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return $this->content->browse($directory);
    }
    
    /**
     * @{inheritDoc}
     */
    public function render($route, array $data = [])
    {
        return $this->renderer->render(
            $this->content->fetch($route, $data)
        );
    }
}