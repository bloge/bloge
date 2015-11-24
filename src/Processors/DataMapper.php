<?php

namespace Bloge\Processors;

use Bloge\Processor;

class DataMapper implements Processor
{
    /**
     * @var array $map
     */
    protected $map;
    
    /**
     * @param arary $map
     */
    public function __construct(array $map = [])
    {
        $this->map = $map;
    }
    
    /**
     * @param string $file
     * @param array $data
     */
    public function map($file, array $data)
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