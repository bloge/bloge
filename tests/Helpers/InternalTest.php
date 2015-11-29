<?php

/**
 * This class is the only class that follows different methods arrangement.
 *
 * Usually, all of dataProviders go on the top, but here's dataProviders are 
 * behind their corresponding test methods.
 */
class InternalTest extends TestCase
{
    public function visibleFiles()
    {
        return [
            ['/abc/.htaccess', false],
            ['/.htaccess', false],
            ['/abc.php', true],
            ['~/.vim', false]
        ];
    }
    
    /**
     * @dataProvider visibleFiles
     */
    public function testIsFileVisible($file, $expected)
    {
        $this->assertEquals($expected, Bloge\isFileVisible($file));
    }
    
    public function hasExtensions()
    {
        return [
            ['index.php', true],
            ['.htaccess', false],
            ['test.xml.php', true],
            ['hello_world', false],
            ['~/.vim', false]
        ];
    }
    
    /**
     * @dataProvider hasExtensions
     */
    public function testHasExtension($file, $expected)
    {
        $this->assertEquals($expected, Bloge\hasExtension($file));
    }
    
    public function removeExtensions()
    {
        return [
            ['index.php', 'index'],
            ['.htaccess', '.htaccess'],
            ['test.xml.php', 'test.xml'],
            ['hello_world', 'hello_world'],
            ['~/.vim', '~/.vim']
        ];
    }
    
    /**
     * @dataProvider removeExtensions
     */
    public function testRemoveExtension($file, $expected)
    {
        $this->assertEquals($expected, Bloge\removeExtension($file));
    }
    
    public function paths()
    {
        return [
            [__DIR__, ['InternalTest']],
            [MAIN_DIR . '/front', ['index']]
        ];
    }
    
    /**
     * @dataProvider paths
     */
    public function testListFiles($basepath, $expected)
    {
        $this->assertEquals($expected, Bloge\listFiles($basepath, $basepath));
    }
    
    public function endsWith()
    {
        return [
            ['index.php', '.php'],
            ['hello_world', '_world'],
            ['abc', 'abc'],
            ['abc', 'bc'],
            ['утф-8', 'тф-8']
        ];
    }
    
    /**
     * @dataProvider endsWith
     */
    public function testEndsWith($string, $with)
    {
        $this->assertTrue(Bloge\endsWith($string, $with));
    }
}