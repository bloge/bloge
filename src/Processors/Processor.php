<?php

namespace Bloge\Processors;

class Processor implements \Bloge\Processor
{
    /**
     * @var array $processors
     */
    protected $processors = [];
    
    /**
     * @var array $map
     */
    protected $map = [];
    
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
     * @param string $path
     * @param array $data
     * @return \Bloge\Processor $this
     */
    public function map($path, array $data)
    {
        $this->map[$path] = $data;
        
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
        
        if (isset($this->map[$path])) {
            $data = array_merge($data, $this->map[$path]);
        }
        
        return $data;
    }
}