<?php

namespace Bloge\Basic;

class Processor implements \Bloge\Processor
{
    /**
     * @var array $processors
     */
    protected $processors = [];
    
    /**
     * @param callable $callback
     */
    public function add(callable $callback)
    {
        $this->processors[] = $callback;
        
        return $this;
    }
    
    /**
     * @param string $file
     * @param array $data
     * @return array
     */
    public function process($file, array $data)
    {
        foreach ($this->processors as $processor) {
            $data = $processor($file, $data);
        }
        
        return $data;
    }
}