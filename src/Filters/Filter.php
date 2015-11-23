<?php

namespace Bloge\Filters;

/**
 * Filters
 */
class Filter implements \Bloge\Filter
{
    /**
     * @var array $filters
     */
    protected $filters = [];
    
    /**
     * @var callable $function
     */
    protected $function;
    
    public function __construct(callable $function)
    {
        $this->function = $function;
    }
    
    /**
     * @param callable $filter
     */
    public function add(callable $filter)
    {
        $this->filters[] = $filter;
    }
    
    /**
     * @{inheritDoc}
     */
    public function filter(array $data)
    {
        $function = $this->function;
        
        foreach ($this->filters as $filter) {
            $data = $function($data, $filter);
        }
        
        return $data;
    }
    
    /**
     * @{inheritDoc}
     */
    public function filterItem($item)
    {
        foreach ($this->filters as $filter) {
            $item = $filter($item);
        }
        
        return $item;
    }
}