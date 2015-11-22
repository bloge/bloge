<?php

namespace Bloge\Content;

use Bloge\Content;

class Filter implements Content
{
    protected $content;
    protected $cached;
    protected $filters;
    
    public function __construct(Content $content)
    {
        $this->content = $content;    
    }
    
    public function addFilter(callable $filter)
    {
        $this->filters[] = $filter;
    }
    
    public function has($file)
    {
        if (empty($this->cached)) {
            $this->cached = array_flip($this->browse());
        }
        
        return isset($this->cached[$file]);
    }
    
    public function path($path = '')
    {
        return $this->content->path();
    }
    
    public function fetch($file)
    {
        return $this->has($file)
            ? $this->content->fetch($file)
            : [];
    }
    
    public function browse($directory = '')
    {
        $content = $this->content->browse($directory);
        
        foreach ($this->filters as $filter) {
            $content = array_filter($content, $filter);
        }
        
        return $content;
    }
}