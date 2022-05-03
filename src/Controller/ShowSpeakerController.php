<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ShowSpeakerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Speaker;

class ShowSpeakerController
{
    private ShowSpeakerService $showSpeakerService;

    public function __construct(ShowSpeakerService $showSpeakerService)
    {
        $this->showSpeakerService = $showSpeakerService;
    }

    /**
    * Show speaker route.
    * @Route("/speakers/{id}", methods={"GET"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify speaker",
    * )
    *
    * @OA\Response(
    *     response=200,
    *     description="Returns a Speaker on success",
    *     @Model(type=Speaker::class)
    * )
    * @OA\Response(
    *     response=404,
    *     description="Return 404 if a inexistent speaker is provided",
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->showSpeakerService->execute($id);

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
