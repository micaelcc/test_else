<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Dtos\CreateTalkDTO;
use App\Services\CreateTalkService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Talk;

class CreateTalkController
{
    private CreateTalkService $createTalkService;

    public function __construct(CreateTalkService $createTalkService)
    {
        $this->createTalkService = $createTalkService;
    }

  /**
   * Create talk route.
   * @Route("/talks", methods={"POST"})
   * @OA\RequestBody(
   *    @Model(type=CreateTalkDTO::class)
   * )
   *
   * @OA\Response(
   *     response=200,
   *     description="Returns an talk on success",
   *     @Model(type=Talk::class)
   * )
   * @OA\Response(
   *     response=400,
   *     description="Return 400 if a invalid data is provided",
   * )
   * @OA\Response(
   *     response=404,
   *     description="Return 404 if a not existent event or speaker is provided",
   * )
   */
    public function handle(Request $request): Response
    {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $converted = new CreateTalkDTO($jsonData);

            $response = $this->createTalkService->execute($converted);

            return (new JsonResponse())
            ->setStatusCode(201)
            ->setData($response->toJson());
        } catch (\Exception $error) {
            return (new JsonResponse())
            ->setStatusCode($error->getCode())
            ->setData($error->__toString());
        } catch (\TypeError $error) {
            return (new JsonResponse())
            ->setStatusCode(400)
            ->setData($error->__toString());
        }
    }
}
