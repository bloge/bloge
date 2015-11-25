<?php

use Bloge\Filters\Filter;

class FilterTest extends TestCase
{
    public function data()
    {
        return [
            [
                ['/abc/', '/def/', '/foo.php'],
                ['/abc/', '/def/', false]
            ],
            [
                ['/hello_world/', '/.htaccess'],
                ['/hello_world/', false]
            ]
        ];
    }
    
    public function items()
    {
        return [
            ['/filter.php', false],
            ['/filter/', '/filter/']
        ];
    }
    
    private function filter()
    {
        $filter = new Filter;
        $filter->add(function ($value) {
            return strpos($value, '.') === false ? $value : false;
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