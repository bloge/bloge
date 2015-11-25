<?php

namespace Bloge\Basic;

use Bloge\FileNotFoundException;

class Renderer implements \Bloge\Renderer
{
    /**
     * @var string $path
     */
    protected $path;
    
    /**
     * @var array $data
     */
    protected $data = [];
    
    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = chop($path, '/');
    }
    
    /**
     * @{inheritDoc} 
     */
    public function partial($view, array $data = [])
    {
        $path = "{$this->path}/$view";
        
        if (!file_exists($path)) {
            throw new FileNotFoundException($view, $this->path);
        }
        
        return \Bloge\render($path, array_merge($this->data, $data));
    }
    
    /**
     * @{inheritDoc} 
     */
    public function render($layout, array $data = [])
    {
        $data['theme'] = $this;
        $this->data = $data;
        
        return $this->partial($layout, $data);
    }
}