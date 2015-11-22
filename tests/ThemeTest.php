<?php

use Bloge\Basic\Theme;
use Bloge\Theme as ITheme;

class ThemeTest extends TestCase
{
    public function partials()
    {
        return [
            ['footer.php', 'Doge (c) 2015', true],
            ['header.php', 'Doge\'s bloge', true]
        ];
    }
    
    public function failingPartials()
    {
        return [
            ['foobar.php'],
            ['aakbar.php']
        ];
    }
    
    private function createTheme()
    {
        return new Theme(THEME_DIR);
    }
    
    /**
     * @dataProvider partials
     */
    public function testHas($file, $_, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->createTheme()->has($file)
        );
    }
    
    /**
     * @dataProvider partials
     */
    public function testPartial($file, $expected)
    {
        $this->assertEquals(
            $expected, 
            $this->createTheme()->partial($file)
        );
    }
    
    /**
     * @dataProvider failingPartials
     * @expectedException \Bloge\FileNotFoundException
     */
    public function testFailingPartial($file)
    {
        $this->createTheme()->partial($file);
    }
    
    public function testRender()
    {
        $this->assertEquals(
            "Doge's bloge \nTitle \nContent \nDoge (c) 2015",
            $this->createTheme()->render('layout.php', [
                'title'   => 'Title',
                'content' => 'Content'
            ])
        );
    }
}