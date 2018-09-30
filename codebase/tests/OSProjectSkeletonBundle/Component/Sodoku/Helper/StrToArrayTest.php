<?php

namespace Tests\OSProjectSkeletonBundle\Component\Sodoku\Helper;

use OSProjectSkeletonBundle\Component\Sodoku\Helper\StrToArray;
use Tests\OSProjectSkeletonBundle\BaseTestCase;

class StrToArrayTest extends BaseTestCase
{
    /**
     * @test
     * @dataProvider processProvider
     */
    public function process($array, $grid)
    {
        $this->assertEquals($grid, StrToArray::process($array));
    }

    public function processProvider()
    {
        return [
            [
                'array' => '1,2,3,4'.PHP_EOL.'2,3,4,1'.PHP_EOL.'3,4,1,2'.PHP_EOL.'4,1,2,3',
                'grid' => [0 => [1, 2, 3, 4], 1 => [2, 3, 4, 1], 2 => [3, 4, 1, 2], 3 => [4, 1, 2, 3]],
            ],
            [
                'array' => '1,2,3,4'.PHP_EOL.'2,3,4,1'.PHP_EOL.'3,4,1,2'.PHP_EOL.'4,1,2,3'.PHP_EOL,
                'grid' => [0 => [1, 2, 3, 4], 1 => [2, 3, 4, 1], 2 => [3, 4, 1, 2], 3 => [4, 1, 2, 3]],
            ],
            [
                'array' => '4'.PHP_EOL,
                'grid' => [0 => [4]],
            ],
        ];
    }
}
