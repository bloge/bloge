<?php

use Bloge\Content;

class ArrayContent implements Content
{
    protected $content;
    
    public function __construct(array $content = [])
    {
        $this->content = $content;
    }
    
    public function has($file)
    {
        return isset($this->content[$file]);
    }
    
    public function fetch($file)
    {
        return $this->has($file) 
            ? $this->content[$file]
            : [];
    }
    
    public function browse($directory = '')
    {
        return array_keys($this->content);
    }
}