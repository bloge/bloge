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
     * @param array $data
     * @return string
     */
    public function render($route, array $data = []);
}