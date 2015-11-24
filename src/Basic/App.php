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
    
    /**
     * @{inheritDoc}
     */
    public function build($destination)
    {
        $destination = chop($destination, '/');
        
        foreach ($this->creator->browse() as $file) {
            $name = \Bloge\replaceExtension($file, 'html');
            
            \Bloge\expandPath($name, $destination);
            file_put_contents("$destination/$name", $this->render($file));
        }
    }
}