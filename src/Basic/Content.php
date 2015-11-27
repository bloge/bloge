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
    public function fetch($path, array $data = [])
    {
        $file = \Bloge\globPath($this->path($path));
        
        if (!is_file($file)) {
            throw new NotFoundException($path);
        }
        
        return \Bloge\renderData($file, $data);
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return \Bloge\listFiles($this->path($directory), $this->path);
    }
}