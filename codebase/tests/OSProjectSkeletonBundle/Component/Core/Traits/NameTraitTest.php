<?php

namespace Tests\OSProjectSkeletonBundle\Component\Core\Traits;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Core\Traits\NameTrait;

class NameTraitTest extends BaseTestCase
{
    const NAME = 'MrMasterOfNone';

    protected $magicClass;

    public function setUp()
    {
        $this->magicClass = new class() {
            use NameTrait;

            public function __construct()
            {
                $this->setName(NameTraitTest::NAME);
            }
        };
    }

    /**
     * @test
     */
    public function getCreatedAt()
    {
        $this->assertEquals(
            NameTraitTest::NAME,
            $this->magicClass->getName()
        );
    }
}
