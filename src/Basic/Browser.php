<?php

namespace Bloge\Basic;

class Browser implements \Bloge\Browser
{
    protected $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function path($path = '') {
        return "{$this->path}/$path";
    }
    
    public function has($file)
    {
        return is_file($this->path($file));
    }
    
    public function browse($directory = '')
    {
        return \Bloge\listFiles($this->path($directory), $this->path);
    }
}