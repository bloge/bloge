<?php

namespace Bloge;

/**
 * App interface
 * 
 * Implementation of this interface is a facade for listing and rendering
 * content
 * 
 * @package Bloge
 */
interface App 
{
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '');
    
    /**
     * @param string $route
     * @param array $data
     * @return string
     */
    public function render($route, array $data = []);
}