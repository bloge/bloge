<?php

namespace Bloge\Renderers;

/**
 * Renderer interface
 * 
 * Implementation of this interface is responsible for rendering 
 * content data passed into the render method
 * 
 * @package bloge
 */
interface IRenderer
{
    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    public function partial($view, array $data = []);
    
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data = []);
}