<?php

namespace Bloge\Basic;

class Dispatcher implements \Bloge\Dispatcher
{
    /**
     * @var array $routes
     */
    protected $routes = [];
    
    /**
     * @var array $aliases
     */
    protected $aliases = [];
    
    /**
     * @var array $ignores
     */
    protected $ignores = [];
    
    /**
     * @var array $maps
     */
    protected $maps = [];
    
    /**
     * @param array $routes 
     */
    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }
    
    /**
     * @param array $routes 
     */
    public function routes(array $routes)
    {
        $this->routes = $routes;
    }
    
    /**
     * @param string $from
     * @param string $to
     */
    public function alias($from, $to)
    {
        $this->aliases[$from] = $to;
    }
    
    /**
     * @param string|callable $route
     */
    public function ignore($route)
    {
        if (is_callable($route)) {
            foreach (array_filter($this->routes, $route) as $route) {
                $this->ignores[$route] = '';
            }
        }
        else {
            $this->ignores[$route] = '';
        }
    }
    
    /**
     * @param string $from
     * @param string $to
     */
    public function map($from, $to)
    {
        $this->maps[$from] = $to;
    }
    
    /**
     * @{inheritDoc}
     */
    public function compile()
    {
        $map = array_combine(
            $this->routes, 
            $this->routes
        );
        
        foreach ($this->aliases as $from => $to) {
            $map[$to] = $from;
        }
        
        $map = array_filter($map, function ($route) {
            return !isset($this->ignores[$route]);
        });
        
        foreach ($this->maps as $from => $to) {
            unset($map[$from]);
            
            $map[$to] = $from;
        }
        
        return $map;
    }
    
    /**
     * @{inheritDoc}
     */
    public function dispatch($route)
    {
        $map = $this->compile();
        
        return isset($map[$route]) ? $map[$route] : '';
    }
}