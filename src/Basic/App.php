<?php

namespace Bloge\Basic;

class App implements \Bloge\App
{
    protected $content;
    protected $theme;
    
    public function __construct(Content $content, Theme $theme)
    {
        $this->content = $content;
        $this->theme = $theme;
    }
    
    public function render($route = '')
    {
        $route = $route ?: 'index.php';
        $data  = $this->content->fetch($route);
        
        return $this->theme->render('layout.php', $data);
    }
    
    public function build($destination)
    {
        $path = $this->content->path();
        
        foreach ($this->content->browse() as $file) {
            $file = substr($file, strlen($path));
            $name = pathinfo($file, PATHINFO_FILENAME) . '.html';
            
            \Bloge\mkdirPath($name, $destination);
            
            file_put_contents("$destination/$name", $this->render($file));
        }
    }
}