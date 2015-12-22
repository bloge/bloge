<?php

namespace Bloge\Content;

use Bloge\NotFoundException;

/**
 * Front matter content
 * 
 * @package bloge
 */
class FrontMatter extends FileSystem
{
    /**
     * @const string SEPARATOR Header and content separator
     */
    const SEPARATOR = "---\n";
    
    /**
     * @{inheritDoc} 
     */
    public function fetch($path, array $data = [])
    {
        $file = \Bloge\globPath($this->path($path));
        
        if (!is_file($file)) {
            throw new NotFoundException($path);
        }
        
        return \Bloge\frontMatter(file_get_contents($file), static::SEPARATOR);
    }
}