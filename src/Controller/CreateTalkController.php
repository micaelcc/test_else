<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Dtos\CreateTalkDTO;
use App\Services\CreateTalkService;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateTalkController
{
    private CreateTalkService $createTalkService;

    public function __construct(CreateTalkService $createTalkService)
    {
        $this->createTalkService = $createTalkService;
    }

  /**
   * @Route("/talks", methods={"POST"})
   */
    public function handle(Request $request): Response
    {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $converted = new CreateTalkDTO($jsonData);

            $response = $this->createTalkService->execute($converted);

            return (new JsonResponse())
            ->setStatusCode(201)
            ->setData($response->toJson());
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
