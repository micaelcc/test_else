<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\DeleteEventService;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteEventController
{
    private DeleteEventService $deleteEventService;

    public function __construct(DeleteEventService $deleteEventService)
    {
        $this->deleteEventService = $deleteEventService;
    }

  /**
   * @Route("/events/{id}", methods={"DELETE"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $this->deleteEventService->execute($id);

            return (new JsonResponse())
            ->setStatusCode(204);
        } catch (\Exception $error) {
            return (new JsonResponse())
            ->setStatusCode($error->getCode())
            ->setData($error->__toString());
        }
    }
}
