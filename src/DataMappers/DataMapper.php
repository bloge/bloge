<?php

namespace Bloge\DataMappers;

/**
 * DataMapper implementation
 * 
 * Allows to map data to specific route, all routes or based on callable.
 * 
 * @package bloge
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
    public function map($path, $data = '')
    {
        if (is_array($path)) {
            foreach ($path as $key => $value) {
                $this->map[$key] = $value;
            }
        }
        else {
            $this->map[$path] = $data;
        }
        
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
        
        foreach ($this->globalMap as $map) {
            $data = array_merge($data, is_callable($map) 
                ? $map($path) 
                : $map);
        }
        
        if (isset($this->map[$path])) {
            $data = array_merge($data, $this->map[$path]);
        }
        
        return $data;
    }
}