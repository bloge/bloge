<?php

use Bloge\Basic\Theme;
use Bloge\Theme as ITheme;

class ThemeTest extends TestCase
{
    public function partials()
    {
        return [
            ['footer.php', 'Doge (c) 2015', true],
            ['header.php', 'Doge\'s bloge', true],
            ['foobar.php', ITheme::NOT_FOUND, false]
        ];
    }
    
    private function createTheme()
    {
        return new Theme(__DIR__ . '/resources/theme');
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
     * @dataProvider partials
     */
    public function testHas($file, $_, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->createTheme()->has($file)
        );
    }
    
    public function testLayout()
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