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
            $data = array_map($filter, $data);
        }
        
        return $data;
    }
    
    /**
     * @{inheritDoc}
     */
    public function filterItem($item)
    {
        return current($this->filter([$item]));
    }
}