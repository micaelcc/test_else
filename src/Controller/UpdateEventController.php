<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dtos\UpdateEventDTO;
use App\Services\UpdateEventService;

class UpdateEventController
{
  private UpdateEventService $updateEventService;

  public function __construct(UpdateEventService $updateEventService)
  {
    $this->updateEventService = $updateEventService;
  }

  /**
   * @Route("/events/{id}", methods={"PATCH"})
   */
  public function handle(int $id, Request $request): Response
  {
    try {
      $jsonData = json_decode($request->getContent(), true);

      $converted = new UpdateEventDTO($jsonData);

      $response = $this->updateEventService->execute($converted, $id);

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