<?php

namespace Bloge\Basic;

use Bloge\FileNotFoundException;

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
    public function path($path = '') {
        return "{$this->path}/$path";
    }
    
    /**
     * @{inheritDoc}
     */
    public function has($file)
    {
        return is_file($this->path($file));
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($file, array $data = [])
    {
        if (!$this->has($file)) {
            throw new FileNotFoundException($file, $this->path);
        }
        
        ob_start();
        
        $data = require $this->path($file);
        $data['content'] = ob_get_clean();
        
        return $data;
    }
    
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '')
    {
        return \Bloge\listFiles($this->path($directory), $this->path);
    }
}