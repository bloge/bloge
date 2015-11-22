<?php

use Bloge\App;

class BlogeTest extends TestCase
{
    public function testInitate()
    {
        $bloge = new App;
        
        $this->assertInstanceOf('\Bloge\App', $bloge);
    }
}