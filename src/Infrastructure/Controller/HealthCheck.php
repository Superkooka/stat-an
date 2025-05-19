<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\UseCase\HealthCheckRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheck extends AController
{
    public function __invoke(): JsonResponse
    {
        $healthcheck = $this->callCommandBus(new HealthCheckRequest('ok'));

        return new JsonResponse(
            [
                'status' => $healthcheck,
            ]
        );
    }
}
