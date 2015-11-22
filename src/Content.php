<?php

namespace Bloge;

interface Content
{
    /**
     * @param string $file
     * @return bool
     */
    public function has($file);
    
    /**
     * @param string $file
     * @throws \Bloge\FileNotFoundException
     * @return array
     */
    public function fetch($file);
    
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '');
}