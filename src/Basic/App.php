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
        $data = $this->content->fetch($route);
        
        return $this->theme->render('layout.php', $data);
    }
    
    public function build($destination)
    {
        $destination = rtrim($destination, '/');
        
        foreach ($this->content->browse() as $file) {
            $info = pathinfo($file);
            $name = "{$info['dirname']}/{$info['filename']}.html";
            
            \Bloge\mkdirPath($name, $destination);
            
            file_put_contents("$destination/$name", $this->render($file));
        }
    }
}