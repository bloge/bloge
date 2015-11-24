<?php

namespace Bloge\Basic;

class App implements \Bloge\App
{
    /**
     * @var \Bloge\Creator
     */
    protected $creator;
    
    /**
     * @var \Bloge\Theme $theme
     */
    protected $theme;
    
    /**
     * @param \Bloge\Content $content
     * @param \Bloge\Theme $theme
     */
    public function __construct(
        \Bloge\Content $content, 
        \Bloge\Theme $theme
    ) {
        $this->creator = new Creator($content);
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