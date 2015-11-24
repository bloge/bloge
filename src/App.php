<?php

namespace Bloge;

interface App 
{
    /**
     * @return \Bloge\Creator
     */
    public function creator();
    
    /**
     * @param string $route
     * @return string
     */
    public function render($route = '');
    
    /**
     * Builds content into $destination folder
     * 
     * @param string $destination
     */
    public function build($destination);
}