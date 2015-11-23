<?php

namespace Bloge\Filters;

class Mapper implements \Bloge\Filter
{
    /**
     * @var array $mappers
     */
    protected $mappers = [];
    
    /**
     * @param callable $mapper
     */
    public function map(callable $mapper)
    {
        $this->mappers[] = $mapper;
    }
    
    /**
     * @{inheritDoc}
     */
    public function filter(array $data)
    {
        foreach ($this->mappers as $mapper) {
            $data = array_map($mapper, $data);
        }
        
        return $data;
    }
    
    /**
     * @{inheritDoc}
     */
    public function filterItem($item)
    {
        foreach ($this->mappers as $mapper) {
            $item = $mapper($item);
        }
        
        return $item;
    }
}