<?php

use Bloge\Basic\Content;

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
                ], 
                true
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
                ],
                true
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
    
    private function createContent()
    {
        return new Content(CONTENT_DIR);
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
     * @dataProvider failingData
     * @expectedException \Bloge\FileNotFoundException
     */
    public function testFailingFetch($file)
    {
        $this->createContent()->fetch($file);
    }
    
    public function testBrowse()
    {
        $this->assertEquals(
            Bloge\listFiles(CONTENT_DIR, CONTENT_DIR),
            $this->createContent()->browse()
        );
    }
    
    public function testBrowseMatchingHas()
    {
        $content = $this->createContent();
        $result = true;
        
        foreach ($content->browse() as $file) {
            $result = $result && $content->has($file);
        }
        
        $this->assertTrue($result);
    }
}