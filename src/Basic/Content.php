<?php

namespace Bloge\Basic;

use Bloge\FileNotFoundException;

class Content implements \Bloge\Content
{
    protected $path;
    
    public function __construct($path)
    {
        $this->path = rtrim($path, '/');
    }
    
    public function has($file)
    {
        $path = $this->path($file);
        
        return file_exists($path) && !is_dir($path);
    }
    
    public function path($path = '') {
        return "{$this->path}/$path";
    }
    
    public function fetch($file)
    {
        if (!$this->has($file)) {
            throw new FileNotFoundException($file, $this->path);
        }
        
        ob_start();
        
        $data = require $this->path($file);
        $data['content'] = ob_get_clean();
        
        return $data;
    }
    
    public function browse($directory = '')
    {
        return \Bloge\listFiles($this->path($directory), $this->path);
    }
}