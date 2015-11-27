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
     * @param string $from
     * @param string $to
     */
    public function alias($from, $to = '')
    {
        if (is_array($from)) {
            $this->aliases = array_merge($this->aliases, $from);
        }
        else {
            $this->aliases[$from] = $to;
        }
        
        return $this;
    }
    
    /**
     * @param string|callable $ignore
     */
    public function ignore($ignore)
    {
        $this->ignores[] = $ignore;
        
        return $this;
    }
    
    /**
     * @param string $from
     * @param string $to
     */
    public function map($from, $to = '')
    {
        if (is_array($from)) {
            foreach ($from as $key => $value) {
                $this->maps[$key] = $value;
            }
        }
        else {
            $this->maps[$from] = $to;
        }
        
        return $this;
    }
    
    /**
     * @{inheritDoc}
     */
    public function fill(array $routes)
    {
        $this->routes = $routes;
        
        return $this;
    }
    
    /**
     * @{inheritDoc}
     */
    public function compile()
    {
        $map = array_combine($this->routes, $this->routes);
        
        foreach ($this->aliases as $from => $to) {
            $map[$to] = $from;
        }
        
        foreach ($this->ignores as $ignore) {
            if (is_callable($ignore)) {
                $map = array_filter($map, function ($route) use ($ignore) {
                    return !$ignore($route);
                });
            }
            else if (isset($map[$ignore])) {
                unset($map[$ignore]);
            }
        }
        
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