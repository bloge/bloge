<?php

namespace Bloge;

/**
 * Renderer interface
 * 
 * Implementation of this interface is responsible for rendering 
 * content data passed into the render method
 * 
 * @package Bloge
 */
interface Renderer
{
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data = []);
}