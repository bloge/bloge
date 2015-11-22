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
        $this->path = rtrim($path);
    }
    
    public function has($view)
    {
        return file_exists($this->path($view));
    }
    
    public function partial($__view__, array $__data__ = [])
    {
        if (!$this->has($__view__)) {
            throw new FileNotFoundException("File '$__view__' was not found in '{$this->path}");
        }
        
        ob_start();
        
        extract(array_merge($this->data, $__data__));
        require($this->path($__view__));
        
        return ob_get_clean();
    }
    
    public function render($layout, array $data = [])
    {
        $data['theme'] = $this;
        $this->data = $data;
        
        return $this->partial($layout, $data);
    }
    
    public function path($path = '') {
        return "{$this->path}/$path";
    }
}