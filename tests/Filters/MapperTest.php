<?php

use Bloge\Filters\Filter;

class MapperTest extends TestCase
{
    public function data()
    {
        return [
            [
                ['/abc/', '/def.php/', '/foo.php'],
                ['/abc/', '/def:php/', '/foo:php']
            ],
            [
                ['/hello_world/', '/.htaccess'],
                ['/hello_world/', '/:htaccess']
            ]
        ];
    }
    
    public function items()
    {
        return [
            ['/filter.php', '/filter:php'],
            ['/filter/', '/filter/']
        ];
    }
    
    private function mapper()
    {
        $mapper = new Filter('\Bloge\array_map');
        $mapper->add(function ($value) {
            return str_replace('.', ':', $value);
        });
        
        return $mapper;
    }
    
    /**
     * @dataProvider data
     */
    public function testFiltering($data, $expected)
    {
        $this->assertEquals($expected, $this->mapper()->filter($data));
    }
    
    /**
     * @dataProvider items
     */
    public function testFilteringItems($item, $expected)
    {
        $this->assertEquals($expected, $this->mapper()->filterItem($item));
    }
}