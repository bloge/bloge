<?php

namespace Bloge\Basic;

class App implements \Bloge\App
{
    /**
     * @var \Bloge\Creator
     */
    protected $creator;
    
    /**
     * @var \Bloge\Renderer $renderer
     */
    protected $renderer;
    
    /**
     * @param \Bloge\Content $creator
     * @param \Bloge\Renderer $renderer
     */
    public function __construct(
        \Bloge\Creator $creator, 
        \Bloge\Renderer $renderer
    ) {
        $this->creator = $creator;
        $this->renderer = $renderer;
    }
    
    /**
     * @{inheritDoc}
     */
    public function creator()
    {
        return $this->creator;
    }
    
    /**
     * @{inheritDoc}
     */
    public function render($route = '')
    {   
        $data = $this->creator->fetch($route);
        
        return $this->renderer->render('layout.php', $data);
    }
}