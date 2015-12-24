<?php

namespace Bloge\Dispatchers;

/**
 * Dispatcher interface
 * 
 * This interface is responsible for remapping routes according to set filters.
 * Filtering should be implemented in subclass.
 * 
 * @package bloge
 * @see \Bloge\Basic\Dispatcher
 */

interface IDispatcher
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