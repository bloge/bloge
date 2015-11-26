<?php

namespace Bloge;

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