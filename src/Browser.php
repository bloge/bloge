<?php

namespace Bloge;

interface Browser
{
    /**
     * @param string $file
     * @return bool
     */
    public function has($file);
    
    /**
     * @param string $file
     * @return string
     */
    public function path($file);
    
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '');
}