<?php

namespace Bloge;

interface App 
{
    /**
     * @return \Bloge\Content
     */
    public function content();
    
    /**
     * @param string $route
     * @return string
     */
    public function render($route = '');
}