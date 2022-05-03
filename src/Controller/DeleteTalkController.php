<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\DeleteTalkService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Helper\HttpResponses;
use App\Helper\TalkNotFoundError;

class DeleteTalkController
{
    private DeleteTalkService $deleteTalkService;

    public function __construct(DeleteTalkService $deleteTalkService)
    {
        $this->deleteTalkService = $deleteTalkService;
    }

    /**
    * Delete talk route.
    * @Route("/talks/{id}", methods={"DELETE"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify talk",
    * )
    *
    * @OA\Response(
    *     response=204,
    *     description="Returns 204 if delete was successful",
    * )
    * @OA\Response(
    *     response=404,
    *     description="Return 404 if a inexistent talk is provided",
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $this->deleteTalkService->execute($id);

            return HttpResponses::deleted();
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (TalkNotFoundError $error) {
            return HttpResponses::notFound($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
