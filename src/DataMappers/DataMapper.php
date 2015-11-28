<?php

namespace Bloge\DataMappers;

class DataMapper implements \Bloge\DataMapper
{
    /**
     * @var array $map
     */
    protected $map = [];
    
    /**
     * @param string $path
     * @param array $data
     * @return \Bloge\DataMapper
     */
    public function map($path, array $data)
    {
        $this->map[$path] = $data;
        
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
        
        return $data;
    }
}