<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;

class HttpResponses
{
    static function badRequest(\TypeError $error): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(400)
        ->setData($error->__toString());
    }

    static function created(array $data): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(201)
        ->setData($data);
    }

    static function serverError(\Exception $error): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(500)
        ->setData($error->__toString());
    }

    static function notFound(\Exception $error): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(404)
        ->setData($error->__toString());
    }

    static function ok(array $data = []): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(200)
        ->setData($data);
    }

    static function deleted(): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(204);
    }

    static function conflict(\Exception $error): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(409)
        ->setData($error->__toString());
    }

    static function updated(array $data): JsonResponse
    {
        return (new JsonResponse())
        ->setStatusCode(200)
        ->setData($data);
    }
}
