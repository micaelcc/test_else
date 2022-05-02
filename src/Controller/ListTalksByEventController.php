<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ListTalksByEventService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListTalksByEventController
{
    private ListTalksByEventService $listTalksByEventService;

    public function __construct(ListTalksByEventService $listTalksByEventService)
    {
        $this->listTalksByEventService = $listTalksByEventService;
    }

  /**
   * @Route("/events/{id}/talks", methods={"GET"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->listTalksByEventService->execute($id);

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
