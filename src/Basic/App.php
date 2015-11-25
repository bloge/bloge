<?php

namespace Bloge\Basic;

class App implements \Bloge\App
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
    public function content()
    {
        return $this->content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function render($route, array $data = [])
    {   
        $data = $this->content->fetch($route);
        
        return $this->renderer->render('layout.php', $data);
    }
}