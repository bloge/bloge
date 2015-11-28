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
}