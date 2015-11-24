<?php

namespace Bloge;

interface Builder
{
    /**
     * @param \Bloge\App;
     */
    public function __construct(App $app);
    
    /**
     * Builds content into $destination folder
     * 
     * @param string $destination
     * @throws \Bloge\NotDirectoryException If $destination isn't a directory
     * @throws \Bloge\NotWritableException If $destination isn't writable
     */
    public function build($destination);
}