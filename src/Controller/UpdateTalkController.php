<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dtos\UpdateTalkDTO;
use App\Services\UpdateTalkService;

class UpdateTalkController
{
    private UpdateTalkService $updateTalkService;

    public function __construct(UpdateTalkService $updateTalkService)
    {
        $this->updateTalkService = $updateTalkService;
    }

  /**
   * @Route("/talks/{id}", methods={"PATCH"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $converted = new UpdateTalkDTO($jsonData);

            $response = $this->updateTalkService->execute($converted, $id);

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
