<?php

use Bloge\Filters\Filter;

class FilterTest extends TestCase
{
    public function data()
    {
        return [
            [
                function ($route) {
                    return strpos($route, '.') === false ? $route : false;
                },
                ['abc', 'def', 'foo.php'],
                ['abc', 'def', false]
            ],
            [
                function ($route) {
                    return str_replace('en/projects', 'projects', $route);
                },
                ['hello_world', 'en/projects', 'ru/projects', 'projects'],
                ['hello_world', 'projects', 'ru/projects', 'projects']
            ],
            [
                function ($route) {
                    return preg_match('/^_|\/_/', $route) > 0 ? false : $route;
                },
                ['_drafts', 'posts/_post', 'index', 'foo'],
                [false, false, 'index', 'foo']
            ]
        ];
    }
    
    public function items()
    {
        return [
            ['filter.php', false],
            ['filter', 'filter']
        ];
    }
    
    /**
     * @dataProvider data
     */
    public function testFiltering($callback, $data, $expected)
    {
        $filter = new Filter;
        $filter->add($callback);
        
        $this->assertEquals($expected, $filter->filter($data));
    }
    
    /**
     * @dataProvider items
     */
    public function testFilteringItems($item, $expected)
    {
        $filter = new Filter;
        $filter->add(function ($route) {
            return strpos($route, '.') === false ? $route : false;
        });
        
        $this->assertEquals($expected, $filter->filterItem($item));
    }
}