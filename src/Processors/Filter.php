<?php

namespace Bloge\Processors;

use Bloge\Filter as IFilter;

class Filter implements IFilter
{
    protected $filter = [];
    
    public function add(callable $filter)
    {
        $this->filters[] = $filter;
    }
    
    public function filter(array $data)
    {
        foreach ($this->filters as $filter) {
            $data = array_filter($data, $filter);
        }
        
        return $data;
    }
}