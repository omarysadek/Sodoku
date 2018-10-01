<?php

namespace Tests\OSProjectSkeletonBundle\Entity;

use OSProjectSkeletonBundle\Entity\Sodoku;
use OSProjectSkeletonBundle\Component\Sodoku\Helper\StrToArray;
use Tests\OSProjectSkeletonBundle\BaseTestCase;

class SodokuTest extends BaseTestCase
{
    /**
     * @test
     * @group isValid
     * @dataProvider isValidProvider
     */
    public function isValid($array, $isValid)
    {
        $sodoku = new Sodoku(StrToArray::process($array));
        $this->assertEquals($isValid, $sodoku->isValid());
    }

    public function isValidProvider()
    {
        return [
            [
                'array' => '1,4,2,3'.PHP_EOL.'2,3,1,4'.PHP_EOL.'4,2,3,1'.PHP_EOL.'3,1,4,2'.PHP_EOL,
                'isValid' => true,
            ],
            [
                'array' => '5,3,4,6,7,8,9,1,2'.PHP_EOL.'6,7,2,1,9,5,3,4,8'.PHP_EOL.'1,9,8,3,4,2,5,6,7'.PHP_EOL.'8,5,9,7,6,1,4,2,3'.PHP_EOL.'4,2,6,8,5,3,7,9,1'.PHP_EOL.'7,1,3,9,2,4,8,5,6'.PHP_EOL.'9,6,1,5,3,7,2,8,4'.PHP_EOL.'2,8,7,4,1,9,6,3,5'.PHP_EOL.'3,4,5,2,8,6,1,7,9',
                'isValid' => true,
            ],
            [
                'array' => '2,4,2,3'.PHP_EOL.'1,3,2,4'.PHP_EOL.'4,2,3,1'.PHP_EOL.'3,1,4,2'.PHP_EOL,
                'isValid' => false,
            ],
        ];
    }

    /**
     * @test
     * @group uniqueIndexing
     * @dataProvider uniqueIndexingProvider
     */
    public function uniqueIndexing($array, $uniqueIndexing)
    {
        $sodoku = new Sodoku(StrToArray::process($array));
        $this->assertEquals($uniqueIndexing, $sodoku->getUniqueIndexing());
    }

    public function uniqueIndexingProvider()
    {
        return [
            [
                'array' => '1',
                'uniqueIndexing' => [
                    'x0-1' => false,
                    'y0-1' => false,
                ],
            ],
            [
                'array' => '1,2'.PHP_EOL.'2,1',
                'uniqueIndexing' => [
                    'x0-1' => false,
                    'x0-2' => false,
                    'x1-1' => false,
                    'x1-2' => false,
                    'y0-1' => false,
                    'y0-2' => false,
                    'y1-1' => false,
                    'y1-2' => false,
                ],
            ],
            [
                'array' => '1,2,3,4'.PHP_EOL.'2,3,4,1'.PHP_EOL.'3,4,1,2'.PHP_EOL.'4,1,2,3',
                'uniqueIndexing' => [
                    'x0-1' => false,
                    'x0-2' => false,
                    'x0-3' => false,
                    'x0-4' => false,
                    'x1-1' => false,
                    'x1-2' => false,
                    'x1-3' => false,
                    'x1-4' => false,
                    'x2-1' => false,
                    'x2-2' => false,
                    'x2-3' => false,
                    'x2-4' => false,
                    'x3-1' => false,
                    'x3-2' => false,
                    'x3-3' => false,
                    'x3-4' => false,
                    'y0-1' => false,
                    'y0-2' => false,
                    'y0-3' => false,
                    'y0-4' => false,
                    'y1-1' => false,
                    'y1-2' => false,
                    'y1-3' => false,
                    'y1-4' => false,
                    'y2-1' => false,
                    'y2-2' => false,
                    'y2-3' => false,
                    'y2-4' => false,
                    'y3-1' => false,
                    'y3-2' => false,
                    'y3-3' => false,
                    'y3-4' => false,
                ],
            ],
        ];
    }

    /**
     * @test
     * @group pathIndexing
     * @dataProvider pathIndexingProvider
     */
    public function pathIndexing($array, $pathIndexing)
    {
        $sodoku = new Sodoku(StrToArray::process($array));
        $this->assertEquals($pathIndexing, $sodoku->getPathIndexing());
    }

    public function pathIndexingProvider()
    {
        return [
            [
                'array' => '1',
                'pathIndexing' => [
                    0 => [
                        [0 => 0],
                    ],
                ],
            ],
            [
                'array' => '1,2'.PHP_EOL.'2,1',
                'pathIndexing' => [
                    0 => [
                        [0 => 0],
                    ],
                    1 => [
                        [0 => 1],
                    ],
                    2 => [
                        [1 => 0],
                    ],
                    3 => [
                        [1 => 1],
                    ],
                ],
            ],
            [
                'array' => '1,2,3,4'.PHP_EOL.'2,3,4,1'.PHP_EOL.'3,4,1,2'.PHP_EOL.'4,1,2,3',
                'pathIndexing' => [
                    0 => [
                        [0 => 0],
                        [0 => 1],
                        [1 => 0],
                        [1 => 1],
                    ],
                    1 => [
                        [0 => 2],
                        [0 => 3],
                        [1 => 2],
                        [1 => 3],
                    ],
                    2 => [
                        [2 => 0],
                        [2 => 1],
                        [3 => 0],
                        [3 => 1],
                    ],
                    3 => [
                        [2 => 2],
                        [2 => 3],
                        [3 => 2],
                        [3 => 3],
                    ],
                ],
            ],
        ];
    }
}
