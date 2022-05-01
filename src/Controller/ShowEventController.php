<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ShowEventService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowEventController
{
    private ShowEventService $showEventService;

    public function __construct(ShowEventService $showEventService)
    {
        $this->showEventService = $showEventService;
    }

  /**
   * @Route("/events/{id}", methods={"GET"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->showEventService->execute($id);

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
