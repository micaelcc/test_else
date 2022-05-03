<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Services\CreateEventService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dtos\CreateEventDTO;
use App\Entity\Event;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class CreateEventController
{
    private CreateEventService $createEventService;

    public function __construct(CreateEventService $createEventService)
    {
        $this->createEventService = $createEventService;
    }

  /**
   * Create event route
   * @Route("/events", methods={"POST"})
   * @OA\RequestBody(
   *    @Model(type=CreateEventDTO::class)
   * )
   *
   * @OA\Response(
   *     response=200,
   *     description="Returns an event on success",
   *     @Model(type=Event::class)
   * )
   * @OA\Response(
   *     response=400,
   *     description="Return 400 if a invalid data is provided",
   * )
   * @OA\Response(
   *     response=409,
   *     description="Return 409 if already used title is provided",
   * )
   */
    public function handle(Request $request): Response
    {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $converted = new CreateEventDTO($jsonData);

            $response = $this->createEventService->execute($converted);

            return (new JsonResponse())
              ->setData($response->toJson())
              ->setStatusCode(201);
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
