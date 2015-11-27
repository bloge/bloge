<?php

namespace Bloge;

/**
 * Dispatcher interface
 * 
 * This class is responsible for remapping routes according to set filters.
 * Filtering should be implemented in subclass
 * 
 * @package Bloge
 * @see \Bloge\Basic\Dispatcher
 */
interface Dispatcher
{
    /**
     * @param array $routes
     * @return \Bloge\Dispatcher $this
     */
    public function fill(array $routes);
    
    /**
     * @return array
     */
    public function compile();
    
    /**
     * @param string $path
     * @return string
     */
    public function dispatch($path);
}