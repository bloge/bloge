<?php

namespace Bloge\Basic;

class App implements \Bloge\App
{
    protected $content;
    protected $theme;
    
    public function __construct($basepath, Content $content, Theme $theme)
    {
        $this->basepath = $basepath;
        $this->content = $content;
        $this->theme = $theme;
    }
    
    public function basepath()
    {
        return $this->basepath;
    }
    
    public function render($route = '')
    {   
        $data = $this->content->fetch($route);
        
        return $this->theme->render('layout.php', $data);
    }
    
    public function build($destination)
    {
        $destination = rtrim($destination, '/');
        
        foreach ($this->content->browse() as $file) {
            $name = \Bloge\replaceExtension($file, 'html');
            
            \Bloge\expandPath($name, $destination);
            
            file_put_contents("$destination/$name", $this->render($file));
        }
    }
}