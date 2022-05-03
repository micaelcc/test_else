<?php

namespace App\Controller\Speaker;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Speaker\ListTalksBySpeakerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Talk;
use App\Helper\HttpResponses;
use App\Helper\SpeakerNotFoundError;

class ListTalksBySpeakerController
{
    private ListTalksBySpeakerService $listTalksBySpeakerService;

    public function __construct(ListTalksBySpeakerService $listTalksBySpeakerService)
    {
        $this->listTalksBySpeakerService = $listTalksBySpeakerService;
    }

    /**
    * List talks by speaker route.
    * @Route("/speakers/{id}/talks", methods={"GET"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify a speaker",
    * )
    *
    * @OA\Response(
    *     response=200,
    *     description="Returns array of talks",
    *      @OA\JsonContent(
    *        type="array",
    *        @OA\Items(ref=@Model(type=Talk::class))
    *     )
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->listTalksBySpeakerService->execute($id);

            return HttpResponses::ok($response);
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (SpeakerNotFoundError $error) {
            return HttpResponses::notFound($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
