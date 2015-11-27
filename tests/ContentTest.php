<?php

use Bloge\Content\BasicContent;

/**
 * @todo cleanup data() dataProvider
 */
class ContentTest extends TestCase
{
    public function data()
    {
        return [
            [
                'index.php', 
                [
                    'title' => 'hello', 
                    'content' => 'Hello!'
                ]
            ],
            [
                'project.php', 
                [
                    'title' => 'Much projects',
                    'content' => '
Much projects, so awesome:

* Doge food
* Doge bloge
* Doge meme
* Dogescript
'
                ]
            ],
            [
                'with_data.php',
                [
                    'title' => 'Data',
                    'content' => 'Title
Description'
                ],
                [
                    'description' => 'Description'
                ]
            ]
        ];
    }
    
    public function failingData()
    {
        return [
            ['foobar.php'],
            ['tron.php']
        ];
    }
    
    private function content()
    {
        return new BasicContent(CONTENT_DIR);
    }
    
    /**
     * @dataProvider data
     */
    public function testFetch($file, $expected, $data = [])
    {
        $this->assertEquals(
            $expected, 
            $this->content()->fetch($file, $data)
        );
    }
    
    /**
     * @dataProvider failingData
     * @expectedException \Bloge\NotFoundException
     */
    public function testFailingFetch($file)
    {
        $this->content()->fetch($file);
    }
    
    public function testBrowse()
    {
        $this->assertEquals(
            Bloge\listFiles(CONTENT_DIR, CONTENT_DIR),
            $this->content()->browse()
        );
    }
    
    public function testBrowseMatchingFetch()
    {
        $content = $this->content();
        
        foreach ($content->browse() as $file) {
            $content->fetch($file);
        }
        
        $this->assertTrue(true);
    }
}