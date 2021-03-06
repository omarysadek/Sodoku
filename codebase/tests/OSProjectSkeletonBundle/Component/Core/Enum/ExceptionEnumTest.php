<?php

namespace Tests\OSProjectSkeletonBundle\Component\Core\Enum;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Core\Enum\ExceptionEnum;

class ExceptionEnumTest extends BaseTestCase
{
    /**
     * @test
     */
    public function errorThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid exception code - #'.ExceptionEnum::INVALID_EXCEPTION_CODE);

        ExceptionEnum::throwInvalidArgumentException('', 0);
    }

    /**
     * @test
     * @dataProvider throwInvalidArgumentExceptionProvider
     */
    public function throwInvalidArgumentException($message, $code, $exceptionName)
    {
        $this->expectException($exceptionName);
        $this->expectExceptionMessage($message.' - #'.$code);

        ExceptionEnum::throwInvalidArgumentException($message, $code);
    }

    /**
     * @return array
     */
    public function throwInvalidArgumentExceptionProvider()
    {
        return [
            [
                'message' => 'error message',
                'code' => ExceptionEnum::INVALID_EXCEPTION_CODE,
                'exceptionName' => \InvalidArgumentException::class,
            ],
        ];
    }
}
