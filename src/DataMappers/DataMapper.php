<?php

namespace Bloge\DataMappers;

/**
 * DataMapper implementation
 * 
 * Allows to map data to specific route, all routes or based on callable
 * 
 * @package Bloge
 */
class DataMapper implements IDataMapper
{
    /**
     * @var array $map
     */
    protected $map = [];
    
    /**
     * @var array $globalMap
     */
    protected $globalMap = [];
    
    /**
     * @param string $path
     * @param array $data
     * @return \Bloge\DataMapper $this
     */
    public function map($path, array $data)
    {
        $this->map[$path] = $data;
        
        return $this;
    }
    
    /**
     * @param callable|array $data
     * @return \Bloge\DataMapper $this
     */
    public function mapAll($data)
    {
        $this->globalMap[] = $data;
        
        return $this;
    }
    
    /**
     * @{inheritDoc}
     */
    public function data($path)
    {
        $data = [];
        
        if (isset($this->map[$path])) {
            $data = $this->map[$path];
        }
        
        foreach ($this->globalMap as $map) {
            $data = array_merge($data, is_callable($map) 
                ? $map($path) 
                : $map);
        }
        
        return $data;
    }
}