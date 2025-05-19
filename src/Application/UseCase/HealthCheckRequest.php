<?php

declare(strict_types=1);

namespace App\Application\UseCase;

readonly class HealthCheckRequest
{
    public function __construct(
        public string $test,
    ) {
    }
}
