<?php

namespace  OSProjectSkeletonBundle\Component\Sodoku\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ValidContentsValidator extends ConstraintValidator
{
    private $constraint;

    /**
     * @param File       $file
     * @param Constraint $constraint
     */
    public function validate($file, Constraint $constraint)
    {
        $this->constraint = $constraint;

        if (!$file instanceof  File) {
            throw new UnexpectedTypeException($file, File::class);
        }

        if (empty($file->getPathname())) {
            $this->addViolation('File does not exists');
        }

        if (empty($fileContents = file_get_contents($file->getPathname()))) {
            $this->addViolation($file->getClientOriginalName().' is empty');
        }

        //Could be more precise and return the line.
        if (!preg_match(
            '/^[0-9,]*$/',
            trim(preg_replace('/\s+/', '', $fileContents))
        )) {
            $this->addViolation('Only comma, numbers and new line are allowed');
        }
    }

    /**
     * @param string $message
     */
    private function addViolation($message)
    {
        $this->context->buildViolation($this->constraint->message)
                ->setParameter('{{txt}}', $message)
                ->addViolation();
    }
}
