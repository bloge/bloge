<?php

namespace Bloge\Content;

use Bloge\NotFoundException;

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