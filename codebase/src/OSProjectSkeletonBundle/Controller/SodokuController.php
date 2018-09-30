<?php

namespace OSProjectSkeletonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Swagger\Annotations as SWG;
use OSProjectSkeletonBundle\Entity\SodokuFile;
use OSProjectSkeletonBundle\Entity\Sodoku;
use OSProjectSkeletonBundle\Component\Sodoku\Helper\StrToArray;

class SodokuController extends BaseController
{
    /**
     * Validated a sodoku grid.
     *
     * @SWG\Post(
     *   @SWG\Parameter(
     *     in="formData",
     *     name="file",
     *     type="file",
     *     required=true
     *   ),
     *   @SWG\Response(response="200", description="")
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postAction(Request $request)
    {
        $sodokuFile = new SodokuFile($request->files->get('file'));

        $validator = $this->get('validator');
        $errors = $validator->validate($sodokuFile);
        if ($errors->count()) {
            return new JsonResponse(['errors' => [(string) $errors]]);
        }

        $sodoku = new Sodoku(StrToArray::process($sodokuFile->getContents()));

        return new JsonResponse(['isValid' => $sodoku->isValid()]);
    }
}
