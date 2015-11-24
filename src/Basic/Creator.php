<?php

namespace Bloge\Basic;

use Bloge\Content as IContent;
use Bloge\Creator as ICreator;

use Bloge\Filter;
use Bloge\Processor;

use Bloge\FileNotFoundException;

class Creator implements ICreator
{
    /**
     * @var \Bloge\Content $content
     */
    protected $content;
    
    /**
     * @var array $map
     */
    protected $map = [];
    
    /**
     * @var array $filters
     */
    protected $filters = [];
    
    /**
     * @var array $processors
     */
    protected $processors = [];
    
    /**
     * @param \Bloge\Content $content
     */
    public function __construct(IContent $content)
    {
        $this->content = $content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function data($processor)
    {
        if (
            !$processor instanceof Processor && 
            !is_callable($processor)
        ) {
            throw new \InvalidArgumentException(
                "Given processor isn't callable or instance of " . 
                "\Bloge\Processor interface!"
            );
        }
        
        $this->processors[] = $processor;
    }
    
    /**
     * @{inheritDoc}
     */
    public function filter($filter)
    {
        if (
            !$filter instanceof Filter && 
            !is_callable($filter)
        ) {
            throw new \InvalidArgumentException(
                "Given filter isn't callable or instance of " . 
                "\Bloge\Filter interface!"
            );
        }
        
        $this->filters[] = $filter;
    }
    
    /**
     * @{inheritDoc}
     */
    public function has($file)
    {
        if (empty($this->map)) {
            $map = $this->browse();

            $this->map = array_combine($map, $map);
        }
        
        return isset($this->map[$file]);
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($file)
    {
        if (!$this->has($file)) {
            throw new FileNotFoundException($file);
        }
        
        $data = $this->content->fetch($this->map[$file]);
        
        foreach ($this->processors as $processor) {
            $data = is_callable($processor)
                ? $processor($data)
                : $processor->process($file, $data);
        }
        
        return $data;
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        $content = $this->content->browse($directory);
        
        foreach ($this->filters as $filter) {
            $content = is_callable($filter) 
                ? $filter($content) 
                : $filter->filter($content);
        }
        
        return $content;
    }
}