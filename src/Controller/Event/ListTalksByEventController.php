<?php

namespace App\Controller\Event;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Event\ListTalksByEventService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Talk;
use App\Helper\HttpResponses;
use App\Helper\EventNotFoundError;

class ListTalksByEventController
{
    private ListTalksByEventService $listTalksByEventService;

    public function __construct(ListTalksByEventService $listTalksByEventService)
    {
        $this->listTalksByEventService = $listTalksByEventService;
    }

    /**
    * List talks by event route.
    * @Route("/events/{id}/talks", methods={"GET"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify a event",
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
            $response = $this->listTalksByEventService->execute($id);

            return HttpResponses::ok($response);
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (EventNotFoundError $error) {
            return HttpResponses::notFound($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
