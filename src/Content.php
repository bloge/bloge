<?php

namespace Bloge;

interface Content
{
    /**
     * @param string $file
     * @return array
     */
    public function fetch($file);
    
    /**
     * @param string $file
     * @return bool
     */
    public function has($file);
    
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '');
    
    /**
     * @param string $path
     * @return string
     */
    public function path($path = '');
}