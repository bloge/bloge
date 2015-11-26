<?php

use Bloge\Basic\Dispatcher;

class DispatcherTest extends TestCase
{
    public function aliases()
    {
        return [
            [
                ['index', 'blog', 'projects'],
                ['projects' => 'en/projects'],
                [
                    'index' => 'index',
                    'blog' => 'blog',
                    'projects' => 'projects',
                    'en/projects' => 'projects'
                ]
            ]
        ];
    }
    
    public function ignores()
    {
        return [
            [
                ['index', 'blog', 'projects', '_drafts/blog'],
                ['_drafts/blog'],
                [
                    'index' => 'index',
                    'blog' => 'blog',
                    'projects' => 'projects'
                ]
            ],
            [
                ['index', 'blog', 'projects', '_drafts/blog', '_drafts/hello', '_foobar'],
                [
                    function ($value) {
                        return preg_match('/^_|\/_/', $value);
                    }
                ],
                [
                    'index' => 'index',
                    'blog' => 'blog',
                    'projects' => 'projects'
                ]
            ]
        ];
    }
    
    public function maps()
    {
        return [
            [
                ['index', 'blog', 'projects'],
                ['blog' => 'posts'],
                [
                    'index' => 'index',
                    'posts' => 'blog',
                    'projects' => 'projects'
                ]
            ]
        ];
    }
    
    /**
     * @dataProvider aliases
     */
    public function testAliasingCompiling($routes, $aliases, $expected)
    {
        $dispatcher = new Dispatcher($routes);
        
        foreach ($aliases as $key => $value) {
            $dispatcher->alias($key, $value);
        }
        
        $this->assertEquals($expected, $dispatcher->compile());
    }
    
    /**
     * @dataProvider ignores
     */
    public function testIgnoringCompiling($routes, $ignores, $expected)
    {
        $dispatcher = new Dispatcher($routes);
        
        foreach ($ignores as $ignore) {
            $dispatcher->ignore($ignore);
        }
        
        $this->assertEquals($expected, $dispatcher->compile());
    }
    
    /**
     * @dataProvider maps
     */
    public function testMappingCompiling($routes, $maps, $expected)
    {
        $dispatcher = new Dispatcher;
        // Just to cover another method
        $dispatcher->routes($routes);
            
        foreach ($maps as $key => $value) {
            $dispatcher->map($key, $value);
        }
        
        $this->assertEquals($expected, $dispatcher->compile());
    }
    
    public function testDispatching()
    {
        $dispatcher = new Dispatcher([
            'index',
            'blog',
            'projects',
            '_drafts/blog'
        ]);
        
        $dispatcher->map('blog', 'bloge');
        $dispatcher->alias('projects', 'projectos');
        $dispatcher->ignore('_drafts/blog');
        
        $this->assertEquals('blog', $dispatcher->dispatch('bloge'));
        $this->assertEquals('projects', $dispatcher->dispatch('projectos'));
        $this->assertEquals('projects', $dispatcher->dispatch('projects'));
        $this->assertEquals('', $dispatcher->dispatch('_drafts/blog'));
        $this->assertEquals('', $dispatcher->dispatch('foobar'));
    }
}