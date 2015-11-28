<?php

use Bloge\DataMappers\DataMapper;

class DataMapperTest extends TestCase
{
    public function mappedData()
    {
        return [
            [
                'index',
                [
                    'index' => [
                        'language' => 'en'
                    ]
                ],
                [
                    'language' => 'en'
                ]
            ],
            [
                'projects',
                [
                    'index' => [
                        'language' => 'en'
                    ]
                ],
                []
            ],
            [
                '404',
                [
                    '404' => [
                        'title' => '404 - Not Found'
                    ]
                ],
                [
                    'title' => '404 - Not Found'
                ]
            ]
        ];
    }
    
    public function globalMappedData()
    {
        return [
            [
                'index',
                [
                    ['title' => 'abc'],
                    ['description' => 'abc'],
                    function ($path) {
                        return $path === 'index'
                            ? ['something' => 'else'] 
                            : [];
                    }
                ],
                [
                    'title' => 'abc',
                    'description' => 'abc',
                    'something' => 'else'
                ]
            ],
            [
                '404',
                [
                    function ($path) {
                        return $path === '404'
                            ? ['something' => 'else']
                            : [];
                    },
                    function ($path) {
                        return $path === 'index'
                            ? ['title' => 'abc']
                            : [];
                    }
                ],
                [
                    'something' => 'else'
                ]
            ]
        ];
    }
    
    /**
     * @dataProvider mappedData
     */
    public function testMapping($path, $map, $expected)
    {
        $mapper = new DataMapper;
        
        foreach ($map as $key => $value) {
            $mapper->map($key, $value);
        }
        
        $this->assertEquals($expected, $mapper->data($path));
    }
    
    /**
     * @dataProvider globalMappedData
     */
    public function testGlobalMapping($path, $data, $expected)
    {
        $mapper = new DataMapper;
        
        foreach ($data as $globalData) {
            $mapper->mapAll($globalData);
        }
        
        $this->assertEquals($expected, $mapper->data($path));
    }
}