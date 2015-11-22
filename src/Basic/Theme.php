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
        $this->path = rtrim($path, '/');
    }
    
    public function has($view)
    {
        return file_exists($this->path($view));
    }
    
    public function path($path = '') {
        return "{$this->path}/$path";
    }
    
    public function partial($view, array $data = [])
    {
        if (!$this->has($view)) {
            throw new FileNotFoundException("File '$view' was not found in '{$this->path}");
        }
        
        ob_start();
        
        \Bloge\render($this->path($view), $data);
        
        return ob_get_clean();
    }
    
    public function render($layout, array $data = [])
    {
        $data['theme'] = $this;
        $this->data = $data;
        
        return $this->partial($layout, $data);
    }
}