<?php

namespace OSProjectSkeletonBundle\Controller;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;
use OSProjectSkeletonBundle\Component\Core\Enum\ExceptionEnum;

class BaseController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param ParamFetcher $paramFetcher
     *
     * @return array
     */
    public function extract(ParamFetcher $paramFetcher)
    {
        $params = [];
        $request = $this->get('service_container')->get('request_stack')->getCurrentRequest();

        if (in_array($request->getMethod(), [Request::METHOD_PUT, Request::METHOD_POST])) {
            $params = json_decode($request->getContent(), true);

            if (json_last_error()) {
                ExceptionEnum::throwLogicException('Invalid JSON: '.json_last_error_msg(), ExceptionEnum::INVALID_JSON);
            }

            if (!$params) {
                ExceptionEnum::throwLogicException('For PUT & POST, Request Content can\'t be empty', ExceptionEnum::BODY_REQUIRED);
            }
        }

        return $params;
    }

    /**
     * @param ConstraintViolationListInterface $violations
     */
    protected function checkViolations(ConstraintViolationListInterface $violations)
    {
        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                throw new BadRequestHttpException($violation->getMessage());
            }
        }
    }
}
