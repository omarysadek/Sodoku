<?php

namespace Tests\OSProjectSkeletonBundle\Component\Core\Traits;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Core\Traits\UpdatedAtTrait;

class UpdatedAtTraitTest extends BaseTestCase
{
    const UPDATED_AT = '08/01/2018';

    protected $magicClass;

    public function setUp()
    {
        $this->magicClass = new class() {
            use UpdatedAtTrait;
        };
    }

    /**
     * @test
     */
    public function getCreatedAt()
    {
        $this->magicClass->setUpdatedAt(new \DateTime(UpdatedAtTraitTest::UPDATED_AT));

        $this->assertEquals(
            new \DateTime(UpdatedAtTraitTest::UPDATED_AT),
            $this->magicClass->getUpdatedAt()
        );
    }
}
