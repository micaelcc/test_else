<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Services\CreateEventService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dtos\CreateEventDTO;

class CreateEventController
{
    private CreateEventService $createEventService;

    public function __construct(CreateEventService $createEventService)
    {
        $this->createEventService = $createEventService;
    }

  /**
   * @Route("/events", methods={"POST"})
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
