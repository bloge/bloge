<?php

namespace Bloge\Basic;

use Bloge\Theme as ITheme;

class Theme implements ITheme
{
    protected $path;
    protected $data;
    
    public function __construct($path)
    {
        $this->path = rtrim($path);
    }
    
    public function has($view)
    {
        return file_exists("{$this->path}/$view");
    }
    
    public function partial($__view__, array $__data__ = [])
    {
        if (!$this->has($__view__)) {
            return ITheme::NOT_FOUND;
        }
        
        ob_start();
        
        extract(array_merge($this->data ?: [], $__data__));
        
        require("{$this->path}/$__view__");
        
        return ob_get_clean();
    }
    
    public function render($layout, array $data = [])
    {
        $data['theme'] = $this;
        $this->data = $data;
        
        return $this->partial($layout, $data);
    }
}