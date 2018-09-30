<?php

namespace  OSProjectSkeletonBundle\Component\Sodoku\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidContents extends Constraint
{
    public $message = '{{txt}}';
}
