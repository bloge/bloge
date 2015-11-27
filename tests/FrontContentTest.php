<?php

use Bloge\Content\FrontContent;

class FrontContentTest extends TestCase
{
    public function data()
    {
        return [
            [
                'index',
                [
                    'header' => "title: Hello\n",
                    'content' => "\n# Header\n\nWelcome to reality!"
                ]
            ]
        ];
    }
    
    public function failingData()
    {
        return [
            ['foo-akbar']
        ];
    }
    
    public function content()
    {
        return new FrontContent(MAIN_DIR . '/front');
    }
    
    /**
     * @dataProvider data
     */
    public function testFetching($file, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->content()->fetch($file)
        );
    }
    
    /**
     * @dataProvider failingData
     * @expectedException \Bloge\NotFoundException
     */
    public function testFailingFetching($file)
    {
        $this->content()->fetch($file);
    }
}