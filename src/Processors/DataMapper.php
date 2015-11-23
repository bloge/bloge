<?php

namespace Bloge\Processors;

use Bloge\Processor;

class DataMapper implements Processor
{
    protected $map = [];
    
    public function map($file, $data)
    {
        $this->map[$file] = $data;
    }
    
    /**
     * @{inheritDoc}
     */
    public function process($file, array $data)
    {
        
        
        return isset($this->map[$file])
            ? array_merge($data, $this->map[$file])
            : $data;
    }
}