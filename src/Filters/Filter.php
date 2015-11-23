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
        foreach ($this->filters as $filter) {
            $data = array_filter($data, $filter);
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