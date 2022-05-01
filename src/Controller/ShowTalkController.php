<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ShowTalkService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowTalkController
{
    private ShowTalkService $showTalkService;

    public function __construct(ShowTalkService $showTalkService)
    {
        $this->showTalkService = $showTalkService;
    }

  /**
   * @Route("/talks/{id}", methods={"GET"})
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
