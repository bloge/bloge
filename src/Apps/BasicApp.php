<?php

namespace Bloge\Apps;

use Bloge\App;

/**
 * Basic application
 * 
 * An application without any tweaks. No configuration, easy, simple, fast, and 
 * works straight out of box
 * 
 * @package Bloge
 */
class BasicApp implements App
{
    /**
     * @var \Bloge\Content
     */
    protected $content;
    
    /**
     * @var \Bloge\Renderer $renderer
     */
    protected $renderer;
    
    /**
     * @param \Bloge\Content $content
     * @param \Bloge\Renderer $renderer
     */
    public function __construct(
        \Bloge\Content $content, 
        \Bloge\Renderer $renderer
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