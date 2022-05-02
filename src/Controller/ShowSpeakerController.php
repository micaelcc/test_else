<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ShowSpeakerService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowSpeakerController
{
    private ShowSpeakerService $showSpeakerService;

    public function __construct(ShowSpeakerService $showSpeakerService)
    {
        $this->showSpeakerService = $showSpeakerService;
    }

  /**
   * @Route("/speakers/{id}", methods={"GET"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->showSpeakerService->execute($id);

            return (new JsonResponse())
            ->setStatusCode(200)
            ->setData($response->toJson());
        } catch (\Exception $error) {
            var_dump($error->__toString());
            return (new JsonResponse())
            ->setStatusCode($error->getCode())
            ->setData($error->__toString());
        }
    }
}
