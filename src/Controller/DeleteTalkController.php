<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\DeleteTalkService;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteTalkController
{
    private DeleteTalkService $deleteTalkService;

    public function __construct(DeleteTalkService $deleteTalkService)
    {
        $this->deleteTalkService = $deleteTalkService;
    }

  /**
   * @Route("/talks/{id}", methods={"DELETE"})
   */
    public function handle(int $id, Request $request): Response
    {
        try {
            $this->deleteTalkService->execute($id);

            return (new JsonResponse())
            ->setStatusCode(204);
        } catch (\Exception $error) {
            var_dump($error->__toString());
            return (new JsonResponse())
            ->setStatusCode($error->getCode())
            ->setData($error->__toString());
        }
    }
}
