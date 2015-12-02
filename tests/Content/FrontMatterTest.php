<?php

namespace Bloge\Content;

class FrontMatterTest extends \TestCase
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
            ],
            [
                'hello',
                [
                    'header' => "title: Hello, there\n",
                    'content' => "\nI can include another set of `---`'s above the meta data. Just look on top.\nFirst time it should fail lol."
                ]
            ],
            [
                'no-header',
                [
                    'header' => '',
                    'content' => 'Look, ma. No header!'
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
        return new FrontMatter(MAIN_DIR . '/front');
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