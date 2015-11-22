<?php

namespace Bloge\Basic;

class Content implements \Bloge\Content
{
    protected $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function fetch($file)
    {
        if (!$this->has($file)) {
            return [];
        }
        
        ob_start();
        
        $data = require "{$this->path}/$file";
        $data['content'] = ob_get_clean();
        
        return $data;
    }
    
    public function has($file)
    {
        return file_exists("{$this->path}/$file");
    }
    
    public function browse($directory = '')
    {
        return \Bloge\listFiles("{$this->path}/$directory");
    }
}