<?php

namespace Tests\OSProjectSkeletonBundle\Entity;

use OSProjectSkeletonBundle\Entity\Sodoku;
use OSProjectSkeletonBundle\Component\Sodoku\Helper\StrToArray;
use Tests\OSProjectSkeletonBundle\BaseTestCase;

class SodokuTest extends BaseTestCase
{
    /**
     * @test
     * @dataProvider processProvider
     */
    public function process($array, $isValid)
    {
        $sodoku = new Sodoku(StrToArray::process($array));
        $this->assertEquals($isValid, $sodoku->isValid());
    }

    public function processProvider()
    {
        return [
            [
                'array' => '1,2,3,4'.PHP_EOL.'2,3,4,1'.PHP_EOL.'3,4,1,2'.PHP_EOL.'4,1,2,3',
                'isValid' => true,
            ],
        ];
    }
}
