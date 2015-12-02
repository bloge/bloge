<?php

namespace Bloge\Content;

class RawTest extends \TestCase
{
    public function data()
    {
        return [
            [
                'index',
                [
                    'content' => "# Hello, there!\n\nThat's some text. This file is completely raw."
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
        return new Raw(MAIN_DIR . '/raw');
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