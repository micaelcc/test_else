<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\DeleteEventService;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Helper\HttpResponses;
use App\Helper\EventNotFoundError;

class DeleteEventController
{
    private DeleteEventService $deleteEventService;

    public function __construct(DeleteEventService $deleteEventService)
    {
        $this->deleteEventService = $deleteEventService;
    }

    /**
    * Delete event route.
    * @Route("/events/{id}", methods={"DELETE"})
    * @OA\Parameter(
    *    name="id",
    *    in="path",
    *    description="The field used to identify event",
    * )
    *
    * @OA\Response(
    *     response=204,
    *     description="Returns 204 if delete was successful",
    * )
    * @OA\Response(
    *     response=404,
    *     description="Return 404 if a inexistent event is provided",
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $this->deleteEventService->execute($id);

            return HttpResponses::deleted();
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (EventNotFoundError $error) {
            return HttpResponses::notFound($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
