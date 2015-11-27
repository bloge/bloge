<?php

namespace Bloge\Basic;

use Bloge\NotFoundException;

class Content implements \Bloge\Content
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
    public function fetch($file, array $data = [])
    {
        $path = \Bloge\globPath($this->path($file));
        
        if (!is_file($path)) {
            throw new NotFoundException($file);
        }
        
        return \Bloge\renderData($path, $data);
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return \Bloge\listFiles($this->path($directory), $this->path);
    }
}