<?php

use Bloge\Basic\Content;

class ContentTest extends TestCase
{
    public function data()
    {
        return [
            ['index.php', ['title' => 'hello', 'content' => 'Hello!'], true],
            ['tron.php', [], false]
        ];
    }
    
    private function createContent()
    {
        return new Content(__DIR__ . '/resources/content');
    }
    
    /**
     * @dataProvider data
     */
    public function testFetch($file, $expected)
    {
        $this->assertEquals(
            $expected, 
            $this->createContent()->fetch($file)
        );
    }
    
    /**
     * @dataProvider data
     */
    public function testHas($file, $_, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->createContent()->has($file)
        );
    }
    
    public function testList()
    {
        $this->assertEquals(
            Bloge\listFiles(__DIR__ . '/resources/content'),
            $this->createContent()->browse()
        );
    }
}