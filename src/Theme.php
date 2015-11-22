<?php

namespace Bloge;

interface Theme
{
    /**
     * @const string NOT_FOUND
     */
    const NOT_FOUND = 'FILE_NOT_FOUND';
    
    /**
     * @param string $file
     * @param array $data
     * @return string
     */
    public function partial($file, array $data = []);
    
    /**
     * @param string $file
     * @param array $data
     * @return string
     */
    public function render($file, array $data = []);
}