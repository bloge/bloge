<?php

namespace Bloge\Filters;

use Bloge\Filter;

/**
 * Filters
 */
class Filters implements Filter
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
}