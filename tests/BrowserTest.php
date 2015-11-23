<?php

use Bloge\Basic\Browser;

class BrowserTest extends TestCase
{   
    public function has()
    {
        return [
            ['index.php', true],
            ['project.php', true],
            ['folder/test.php', true],
            ['foobar.php', false],
            ['tron.php', false]
        ];
    }
    
    private function createContent()
    {
        return new Browser(CONTENT_DIR);
    }
    
    /**
     * @dataProvider has
     */
    public function testHas($file, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->createContent()->has($file)
        );
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