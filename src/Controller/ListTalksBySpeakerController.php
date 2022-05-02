<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ListTalksBySpeakerService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListTalksBySpeakerController
{
    private ListTalksBySpeakerService $listTalksBySpeakerService;

    public function __construct(ListTalksBySpeakerService $listTalksBySpeakerService)
    {
        $this->listTalksBySpeakerService = $listTalksBySpeakerService;
    }

  /**
   * @Route("/speakers/{id}/talks", methods={"GET"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->listTalksBySpeakerService->execute($id);

            return (new JsonResponse())
            ->setStatusCode(200)
            ->setData($response);
        } catch (\Exception $error) {
            var_dump($error);
            return (new JsonResponse())
            ->setStatusCode($error->getCode())
            ->setData($error->__toString());
        }
    }
}
