<?php

namespace App\Controller\Event;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dtos\UpdateEventDTO;
use App\Services\UpdateEventService;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Event;
use App\Helper\HttpResponses;
use App\Helper\EventNotFoundError;
use App\Helper\EventTitleAlreadyInUseError;

class UpdateEventController
{
    private UpdateEventService $updateEventService;

    public function __construct(UpdateEventService $updateEventService)
    {
        $this->updateEventService = $updateEventService;
    }

    /**
    * Update event route.
    * @Route("/events/{id}", methods={"PATCH"})
    * @OA\RequestBody(
    *    @Model(type=UpdateEventDTO::class)
    * )
    *
    * @OA\Response(
    *     response=200,
    *     description="Returns updated Event on success",
    *     @Model(type=Event::class)
    * )
    * @OA\Response(
    *     response=400,
    *     description="Return 400 if a invalid data is provided",
    * )
    */
    public function handle(int $id, Request $request): Response
    {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $converted = new UpdateEventDTO($jsonData);

            $response = $this->updateEventService->execute($converted, $id);

            return HttpResponses::updated($response->toJson());
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (EventTitleAlreadyInUseError $error) {
            return HttpResponses::conflict($error);
        } catch (EventNotFoundError $error) {
            return HttpResponses::notFound($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
