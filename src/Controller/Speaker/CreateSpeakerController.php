<?php

namespace App\Controller\Speaker;

use Symfony\Component\Routing\Annotation\Route;
use App\Service\Speaker\CreateSpeakerService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Dtos\CreateSpeakerDTO;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Speaker;
use App\Helper\HttpResponses;
use App\Helper\SpeakerAlreadyExistsError;

class CreateSpeakerController
{
    private CreateSpeakerService $createSpeakerService;

    public function __construct(CreateSpeakerService $createSpeakerService)
    {
        $this->createSpeakerService = $createSpeakerService;
    }

  /**
   * Create speaker route.
   * @Route("/speakers", methods={"POST"})
   * @OA\RequestBody(
   *    @Model(type=CreateSpeakerDTO::class)
   * )
   *
   * @OA\Response(
   *     response=200,
   *     description="Returns an speaker on success",
   *     @Model(type=Speaker::class)
   * )
   * @OA\Response(
   *     response=400,
   *     description="Return 400 if a invalid data is provided",
   * )
   */
    public function handle(Request $request): Response
    {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $converted = new CreateSpeakerDTO($jsonData);

            $response = $this->createSpeakerService->execute($converted);

            return HttpResponses::created($response->toJson());
        } catch (\TypeError $error) {
            return HttpResponses::badRequest($error);
        } catch (SpeakerAlreadyExistsError $error) {
            return HttpResponses::conflict($error);
        } catch (\Exception $error) {
            return HttpResponses::serverError($error);
        }
    }
}
