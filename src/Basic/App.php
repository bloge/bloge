<?php

namespace Bloge\Basic;

class App implements \Bloge\App
{
    /**
     * @var \Bloge\Creator
     */
    protected $creator;
    
    /**
     * @var \Bloge\Renderer $theme
     */
    protected $theme;
    
    /**
     * @param \Bloge\Content $creator
     * @param \Bloge\Renderer $theme
     */
    public function __construct(
        \Bloge\Creator $creator, 
        \Bloge\Renderer $theme
    ) {
        $this->creator = $creator;
        $this->theme = $theme;
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
        
        return $this->theme->render('layout.php', $data);
    }
}