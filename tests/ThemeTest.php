<?php

use Bloge\Basic\Renderer;
use Bloge\Renderer as IRenderer;

class RendererTest extends TestCase
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
            ['aakbar.php']
        ];
    }
    
    private function createRenderer()
    {
        return new Renderer(THEME_DIR);
    }
    
    /**
     * @dataProvider partials
     */
    public function testPartial($file, $expected)
    {
        $this->assertEquals(
            $expected, 
            $this->createRenderer()->partial($file)
        );
    }
    
    /**
     * @dataProvider failingPartials
     * @expectedException \Bloge\FileNotFoundException
     */
    public function testFailingPartial($file)
    {
        $this->createRenderer()->partial($file);
    }
    
    public function testRender()
    {
        $this->assertEquals(
            "Doge's bloge \nTitle \nContent \nDoge (c) 2015",
            $this->createRenderer()->render('layout.php', [
                'title'   => 'Title',
                'content' => 'Content'
            ])
        );
    }
}