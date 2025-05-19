<?php

declare(strict_types=1);

namespace App\Application\UseCase;

class HealthCheck
{
    public function handle(HealthCheckRequest $request): string
    {
        return $request->test;
    }
}
