<?php

namespace Bloge;

interface Dispatcher
{
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