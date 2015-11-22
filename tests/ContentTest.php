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
        return new Content(CONTENT_DIR);
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
            Bloge\listFiles(CONTENT_DIR),
            $this->createContent()->browse()
        );
    }
}