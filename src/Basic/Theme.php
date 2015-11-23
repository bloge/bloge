<?php

namespace Bloge\Basic;

use Bloge\Theme as ITheme;
use Bloge\FileNotFoundException;

class Theme implements ITheme
{
    protected $path;
    protected $data = [];
    
    public function __construct($path)
    {
        $this->path = chop($path, '/');
    }
    
    public function has($view)
    {
        return file_exists("{$this->path}/$view");
    }
    
    public function partial($view, array $data = [])
    {
        if (!$this->has($view)) {
            throw new FileNotFoundException($view, $this->path);
        }
        
        $view = "{$this->path}/$view";
        $data = array_merge($this->data, $data);
        
        return \Bloge\render($view, $data);
    }
    
    public function render($layout, array $data = [])
    {
        $data['theme'] = $this;
        $this->data = $data;
        
        return $this->partial($layout, $data);
    }
}