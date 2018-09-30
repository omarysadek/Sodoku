<?php

namespace Tests\OSProjectSkeletonBundle\Component\Core\Traits;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Core\Traits\UpdatedByTrait;
use OSProjectSkeletonBundle\Entity\User;

class UpdatedByTraitTest extends BaseTestCase
{
    const USER_ID = 148;

    protected $magicClass;

    public function setUp()
    {
        $this->magicClass = new class() {
            use UpdatedByTrait;

            public function __construct()
            {
                $user = new User();
                $user->setId(CreatedByTraitTest::USER_ID);

                $this->setUpdatedBy($user);
            }
        };
    }

    /**
     * @test
     */
    public function getCreatedBy()
    {
        $this->assertEquals(
            self::USER_ID,
            $this->magicClass->getUpdatedBy()->getId()
        );
    }
}
