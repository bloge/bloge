<?php

namespace Bloge;

interface App 
{
    public function content();
    
    /**
     * @param string $route
     * @return string
     */
    public function render($route = '');
}