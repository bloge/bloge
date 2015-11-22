<?php

use Bloge\Content\Mapper;

class MapperTest extends ContentTestCase
{
    public function maps()
    {
        return [
            ['/404.html', true],
            ['/404.php', false],
            ['/index.php', false],
            ['/index/', true]
        ];
    }
    
    public function mapper()
    {
        $mapper = new Mapper($this->content());
        
        $mapper->map('/404.php', '/404.html');
        $mapper->mapAll(function ($file) {
            return str_replace('.php', '/', $file);
        });
        
        return $mapper;
    }
    
    /**
     * @dataProvider maps
     */
    public function testMappedHas($file, $expected)
    {
        $mapper = $this->mapper();
        
        $this->assertEquals($expected, $mapper->has($file));
    }
    
    public function testMappedBrowse()
    {
        $this->assertEquals(
            [
                '/index/',
                '/projects/',
                '/_drafts/post/',
                '/404.html'
            ],
            $this->mapper()->browse()
        );
    }
}