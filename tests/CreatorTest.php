<?php

use Bloge\Basic\Creator;

class CreatorTest extends ContentTestCase
{
    public function creator()
    {
        $creator = new Creator($this->content());
        $creator->filter(function ($data) {
            return array_filter($data, function ($route) {
                return strpos($route, '/_') === false;
            });
        });
        
        return $creator;
    }
    
    public function testCreator()
    {
        $this->assertCount(3, $this->creator()->browse());
    }
}