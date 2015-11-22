<?php

use Bloge\Content\ArrayContent;

class ArrayContentTest extends TestCase
{
    private function content()
    {
        return [
            'index.php' => [
                'title' => 'Hello!', 
                'content' => 'Hello, world!'
            ]
        ];
    }
    
    public function testHas()
    {
        $content = new ArrayContent($this->content());
        
        $this->assertTrue($content->has('index.php'));
    }
    
    public function testFetch()
    {
        $data = $this->content();
        $content = new ArrayContent($data);
        
        $this->assertEquals(
            $data['index.php'],
            $content->fetch('index.php')
        );
    }
    
    public function testBrowse()
    {
        $data = $this->content();
        $content = new ArrayContent($data);
        
        $this->assertEquals(
            array_keys($data),
            $content->browse()
        );
    }
}