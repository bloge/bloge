<?php

use Bloge\Filters\Filter;

class FilterTest extends TestCase
{
    public function data()
    {
        return [
            [
                ['/abc/', '/def/', '/foo.php'],
                ['/abc/', '/def/']
            ],
            [
                ['/hello_world/', '/.htaccess'],
                ['/hello_world/']
            ]
        ];
    }
    
    public function items()
    {
        return [
            ['/filter.php', false],
            ['/filter/', true]
        ];
    }
    
    private function filter()
    {
        $filter = new Filter('array_filter');
        $filter->add(function ($value) {
            return strpos($value, '.') === false;
        });
        
        return $filter;
    }
    
    /**
     * @dataProvider data
     */
    public function testFiltering($data, $expected)
    {
        $this->assertEquals($expected, $this->filter()->filter($data));
    }
    
    /**
     * @dataProvider items
     */
    public function testFilteringItems($item, $expected)
    {
        $this->assertEquals($expected, $this->filter()->filterItem($item));
    }
}