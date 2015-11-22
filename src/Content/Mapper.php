<?php

namespace Bloge\Content;

use Bloge\Content;

class Mapper implements Content
{
    protected $content;
    protected $mappers;
    protected $cached = [];
    
    public function __construct(Content $content)
    {
        $this->content = $content;
    }
    
    public function map($file, $alias)
    {
        $this->mappers[$file] = $alias;
    }
    
    public function mapAll($callback)
    {
        $this->mappers[0][] = $callback;
    }
    
    /** Interface implementation */
    
    public function has($file)
    {
        if (empty($this->cached)) {
            $this->cached = array_combine(
                $this->browse(),
                $this->content->browse()
            );
        }
        
        return isset($this->cached[$file]);
    }
    
    public function fetch($file)
    {
        $file = isset($this->cached[$file]) ? $this->cached[$file]
                                            : null;
        
        if ($file === null) {
            throw new FileNotFoundException("File '$file' not found!");
        }
        
        return $this->content->fetch($file);
    }
    
    public function browse($directory = '')
    {
        $content = $this->content->browse($directory);
        
        $content = array_map(function ($file) {
            $file = isset($this->mappers[$file]) ? $this->mappers[$file]
                                                 : $file;
            
            if (isset($this->mappers[0])) {
                foreach ($this->mappers[0] as $mapper) {
                    $file = $mapper($file);
                }
            }
            
            return $file;
        }, $content);
        
        return $content;
    }
}