<?php

namespace Bloge;

interface App 
{
    /**
     * @param string $directory
     * @return array
     */
    public function content($directory = '');
    
    /**
     * @param string $route
     * @param array $data
     * @return string
     */
    public function render($route, array $data = []);
}