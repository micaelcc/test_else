<?php

namespace App\Controller\Event;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ShowEventService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Event;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Helper\HttpResponses;
use App\Helper\EventNotFoundError;

class ShowEventController
{
    private ShowEventService $showEventService;

    public function __construct(ShowEventService $showEventService)
    {
        $this->showEventService = $showEventService;
    }

    /**
    * Show event route.
    * @Route("/events/{id}", methods={"GET"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify event",
    * )
    *
    * @OA\Response(
    *     response=200,
    *     description="Returns a Event on success",
    *     @Model(type=Event::class)
    * )
    * @OA\Response(
    *     response=404,
    *     description="Return 404 if a inexistent event is provided",
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $response = $this->showEventService->execute($id);

            return HttpResponses::ok($response->toJson());
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (EventNotFoundError $error) {
            return HttpResponses::notFound($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
