<?php

declare(strict_types=1);

namespace App\Application\UseCase;

class DeserializeCompteRenduANRequest
{
    public function __construct(
        public string $filename,
    ) {
    }
}
