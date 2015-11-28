<?php

namespace Bloge\Content;

use Bloge\Content;
use Bloge\NotFoundException;

/**
 * Basic content
 * 
 * @package Bloge
 */
abstract class FileSystem implements Content
{
    /**
     * @var string $path
     */
    protected $path;
    
    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = chop($path, '/');
    }
    
    /**
     * @param string $path
     * @return string
     */
    protected function path($path = '') {
        return "{$this->path}/$path";
    }
    
    /**
     * @{inheritDoc}
     */
    abstract public function fetch($path, array $data = []);
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return \Bloge\listFiles($this->path($directory), $this->path);
    }
}