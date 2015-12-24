<?php

namespace Bloge\Apps;

/**
 * App interface
 * 
 * Implementation of this interface is a facade for listing and rendering
 * content.
 * 
 * @package bloge
 */

interface IApp 
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
    public function fetch($route, array $data = []);
    
    /**
     * @param string $route
     * @param array $data
     * @return string
     */
    public function render($route, array $data = []);
}