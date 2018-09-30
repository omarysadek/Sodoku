<?php

namespace Tests\OSProjectSkeletonBundle\Component\Core\Traits;

use Tests\OSProjectSkeletonBundle\BaseTestCase;
use OSProjectSkeletonBundle\Component\Core\Traits\CreatedByTrait;
use OSProjectSkeletonBundle\Entity\User;

class CreatedByTraitTest extends BaseTestCase
{
    const USER_ID = 148;

    protected $magicClass;

    public function setUp()
    {
        $this->magicClass = new class() {
            use CreatedByTrait;

            public function __construct()
            {
                $user = new User();
                $user->setId(CreatedByTraitTest::USER_ID);

                $this->setCreatedBy($user);
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
            $this->magicClass->getCreatedBy()->getId()
        );
    }
}
