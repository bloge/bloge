<?php

namespace Bloge\Basic;

use Bloge\Content as IContent;
use Bloge\Creator as ICreator;
use Bloge\Filter;
use Bloge\FileNotFoundException;
use Bloge\Processor;

class Creator implements ICreator
{
    protected $map;
    protected $content;
    
    protected $filters = [];
    protected $processors = [];
    
    public function __construct(IContent $content)
    {
        $this->content = $content;
    }
    
    /** Creator interface implementations */
    
    public function data(Processor $processor)
    {
        $this->processors[] = $processor;
    }
    
    public function filter(Filter $filter)
    {
        $this->filters[] = $filter;
    }
    
    /** Content interface implementations */
    
    public function has($file)
    {
        if (empty($this->map)) {
            $map = $this->browse();
            
            $this->map = array_combine($map, $map);
        }
        
        return isset($this->map[$file]);
    }
    
    public function fetch($file)
    {
        if (!$this->has($file)) {
            throw new FileNotFoundException($file);
        }
        
        $data = $this->content->fetch($this->map[$file]);
        
        foreach ($this->processors as $processor) {
            $data = $processor->process($file, $data);
        }
        
        return $data;
    }
    
    public function browse($directory = '')
    {
        $content = $this->content->browse($directory);
        
        foreach ($this->filters as $filter) {
            $content = $filter->filter($content);
        }
        
        return $content;
    }
}