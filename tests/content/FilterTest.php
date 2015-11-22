<?php

use Bloge\Content\Filter;

class FilterTest extends ContentTestCase
{
    public function has()
    {
        return [
            ['/index.php', true],
            ['/_drafts/post.php', false]
        ];
    }
    
    public function filter()
    {
        $filter = new Filter($this->content());
        
        $filter->addFilter(function ($file) {
            return strpos($file, '/_') === false;
        });
        
        return $filter;
    }
    
    public function testFilteredBrowse()
    {
        $this->assertCount(3, $this->filter()->browse());
    }
    
    /**
     * @dataProvider has
     */
    public function testFilteredHas($file, $expected)
    {
        $this->assertEquals($expected, $this->filter()->has($file));
    }
}