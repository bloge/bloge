<?php

use Bloge\App;

class BlogeTest extends TestCase
{
    public function testInitate()
    {
        $this->assertInstanceOf('\Bloge\App', new App);
    }
}