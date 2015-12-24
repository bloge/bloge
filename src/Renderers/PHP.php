<?php

namespace Bloge\Renderers;

use Bloge\NotFoundException;

/**
 * Basic renderer
 * 
 * This renderer renders native PHP templates. Following renderer works this way: 
 * 
 * 1. You pass associative array to `render` or `partial`
 * 2. Renderer extracts given array to current scope
 * 3. PHP requires a file (layout) specified as first parameter in `partial` 
 *    method or in `layout` key of given data (default value is `layout.php`)
 * 4. PHP executes template (from previous point) with extracted variables, 
 *    buffers resulted output and returns this buffered output
 * 
 * @package bloge
 */

class PHP implements IRenderer
{
    /**
     * @var string $path
     */
    protected $path;
    
    /**
     * @var array $data
     */
    protected $data = [];
    
    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = chop($path, '/');
    }
    
    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    public function partial($view, array $data = [])
    {
        $data['theme'] = $this;
        $view = \Bloge\removeExtension($view);
        $path = "{$this->path}/$view.php";
        
        if (!file_exists($path)) {
            throw new NotFoundException($view);
        }
        
        return \Bloge\render($path, array_merge($this->data, $data));
    }
    
    /**
     * @{inheritDoc} 
     */
    public function render(array $data = [])
    {
        $this->data = $data;
        $layout = isset($data['layout']) 
            ? $data['layout'] 
            : 'layout';
        
        return $this->partial($layout, $data);
    }
}