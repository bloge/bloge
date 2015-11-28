<?php

namespace Bloge\Renderers;

class RendererTest extends \TestCase
{
    public function partials()
    {
        return [
            ['footer.php', 'Doge (c) 2015'],
            ['header.php', 'Doge\'s bloge']
        ];
    }
    
    public function failingPartials()
    {
        return [
            ['foobar.php'],
            ['foobaz.php']
        ];
    }
    
    private function renderer()
    {
        return new PHP(THEME_DIR);
    }
    
    /**
     * @dataProvider partials
     */
    public function testPartial($file, $expected)
    {
        $this->assertEquals(
            $expected, 
            $this->renderer()->partial($file)
        );
    }
    
    /**
     * @dataProvider failingPartials
     * @expectedException \Bloge\NotFoundException
     */
    public function testFailingPartial($file)
    {
        $this->renderer()->partial($file);
    }
    
    public function testRender()
    {
        $this->assertEquals(
            "Doge's bloge \nTitle \nContent \nDoge (c) 2015",
            $this->renderer()->render([
                'title'   => 'Title',
                'content' => 'Content'
            ])
        );
    }
}