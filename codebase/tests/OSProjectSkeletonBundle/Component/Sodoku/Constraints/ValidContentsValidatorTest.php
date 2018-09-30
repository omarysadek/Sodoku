<?php

namespace Tests\OSProjectSkeletonBundle\Component\Sodoku\Constraints;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Sodoku\Constraints\ValidContentsValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ValidContentsValidatorTest extends BaseTestCase
{
    private $service;

    private $contextProphesize;

    private $constraintProphesize;

    private $fileProphesize;

    public function setup()
    {
        $this->service = new ValidContentsValidator();
        $this->contextProphesize = $this->prophesize('Symfony\Component\Validator\Context\ExecutionContextInterface');
        $this->service->initialize($this->contextProphesize->reveal());
        $this->constraintProphesize = $this->prophesize('Symfony\Component\Validator\Constraint');
        $this->fileProphesize = $this->prophesize('Symfony\Component\HttpFoundation\File\File');
    }

    /**
     * @test
     */
    public function validateFileClassException()
    {
        $this->expectException(UnexpectedTypeException::class);
        $this->service->validate('', $this->constraintProphesize->reveal());
    }
}
