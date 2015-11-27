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
            ],
            [
                ['index', 'blog', 'projects'],
                [
                    [
                        'index' => 'welcome',
                        'blog'  => 'posts'
                    ]
                ],
                [
                    'index' => 'index',
                    'welcome' => 'index',
                    'blog' => 'blog',
                    'posts' => 'blog',
                    'projects' => 'projects'
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
            ],
            [
                ['index', 'blog', 'projects'],
                [
                    [
                        'index' => 'welcome',
                        'blog' => 'posts'
                    ]
                ],
                [
                    'welcome' => 'index',
                    'posts' => 'blog',
                    'projects' => 'projects'
                ]
            ],
            [
                ['index', '404', 'projects'],
                [
                    [
                        'index' => 'welcome',
                        '404' => '404.html'
                    ]
                ],
                [
                    'welcome' => 'index',
                    '404.html' => '404',
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
            is_array($value)
                ? $dispatcher->alias($value)
                : $dispatcher->alias($key, $value);
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
        $dispatcher->fill($routes);
            
        foreach ($maps as $key => $value) {
            is_array($value)
                ? $dispatcher->map($value)
                : $dispatcher->map($key, $value);
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
        $this->assertEquals('foobar', $dispatcher->dispatch('foobar'));
    }
}