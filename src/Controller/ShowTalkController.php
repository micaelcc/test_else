<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ShowTalkService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Talk;

class ShowTalkController
{
    private ShowTalkService $showTalkService;

    public function __construct(ShowTalkService $showTalkService)
    {
        $this->showTalkService = $showTalkService;
    }

    /**
    * Show talk route.
    * @Route("/talks/{id}", methods={"GET"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify talk",
    * )
    *
    * @OA\Response(
    *     response=200,
    *     description="Returns a Talk on success",
    *     @Model(type=Talk::class)
    * )
    * @OA\Response(
    *     response=404,
    *     description="Return 404 if a inexistent talk is provided",
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->showTalkService->execute($id);

            return (new JsonResponse())
            ->setStatusCode(200)
            ->setData($response->toJson());
        } catch (\Exception $error) {
            return (new JsonResponse())
            ->setStatusCode($error->getCode())
            ->setData($error->__toString());
        }
    }
}
