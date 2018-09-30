<?php

namespace Tests\OSProjectSkeletonBundle\Component\Core\Traits;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Core\Traits\IdTrait;

class IdTraitTest extends BaseTestCase
{
    const ID = 159;

    protected $magicClass;

    public function setUp()
    {
        $this->magicClass = new class() {
            use IdTrait;

            public function __construct()
            {
                $this->id = IdTraitTest::ID;
            }
        };
    }

    /**
     * @test
     */
    public function getCreatedAt()
    {
        $this->assertEquals(
            IdTraitTest::ID,
            $this->magicClass->getId()
        );
    }
}
