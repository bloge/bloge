<?php

namespace Bloge\Processors;

class Processor implements \Bloge\Processor
{
    /**
     * @var array $processors
     */
    protected $processors = [];
    
    /**
     * @param callable $callback
     * @return \Bloge\Processor $this
     */
    public function add(callable $callback)
    {
        $this->processors[] = $callback;
        
        return $this;
    }
    
    /**
     * @{inheritDoc}
     */
    public function process($path, array $data)
    {
        foreach ($this->processors as $processor) {
            $data = $processor($path, $data);
        }
        
        return $data;
    }
}