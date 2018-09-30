<?php

namespace OSProjectSkeletonBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use OSProjectSkeletonBundle\Component\Sodoku\Constraints as OSAssert;

class SodokuFile
{
    /**
     * @Assert\File(
     *     mimeTypes = {"text/plain"}
     * )
     * @OSAssert\ValidContents
     */
    private $file;

    /*
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /*
     * return string
     */
    public function getContents(): string
    {
        return file_get_contents($this->file->getPathname());
    }
}
