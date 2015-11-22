<?php

use Bloge\Content\ArrayContent;
use Bloge\Content\Filter;

class FilterTest extends TestCase
{
    public function has()
    {
        return [
            ['/index.php', true],
            ['/_drafts/post.php', false]
        ];
    }
    
    public function content()
    {
        return new ArrayContent([
            '/index.php' => [
                'title' => 'Hello!',
                'content' => 'Welcome!'
            ],
            '/projects.php' => [
                'title' => 'Projects',
                'content' => 'Projects...'
            ],
            '/_drafts/post.php' => [
                'title' => 'Once upon a time',
                'content' => 'There was a boy'
            ]
        ]);
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
        $this->assertCount(2, $this->filter()->browse());
    }
    
    /**
     * @dataProvider has
     */
    public function testFilteredHas($file, $expected)
    {
        $this->assertEquals($expected, $this->filter()->has($file));
    }
}