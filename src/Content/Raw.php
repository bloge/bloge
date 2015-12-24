<?php

namespace Bloge\Content;

use Bloge\NotFoundException;

/**
 * Raw content provider
 * 
 * Fetches raw content of content file.
 * 
 * @package bloge
 */

class Raw extends FileSystem
{
    /**
     * @{inheritDoc}
     */
    public function fetch($path, array $data = [])
    {
        $file = \Bloge\globPath($this->path($path));
        
        if (!is_file($file)) {
            throw new NotFoundException($path);
        }
        
        return ['content' => file_get_contents($file)];
    }
}