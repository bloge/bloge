<?php

use Bloge\Basic\Creator;
use Bloge\Processors\Markdown;
use Bloge\Processors\Filter;

class CreatorTest extends ContentTestCase
{
    public function creator()
    {
        $creator = new Creator($this->content());
        
        $filter = new Filter;
        $filter->add(function ($route) {
            return strpos($route, '/_') === false;
        });
        
        $creator->data(new Markdown);
        $creator->filter($filter);
        
        return $creator;
    }
    
    public function testCreator()
    {
        $creator = $this->creator();
        
        $this->assertTrue(true);
    }
}