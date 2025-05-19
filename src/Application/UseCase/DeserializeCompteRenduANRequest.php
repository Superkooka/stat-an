<?php

namespace App\Application\UseCase;

class DeserializeCompteRenduANRequest
{
    public function __construct(
        public string $filename,
    ) {
    }
}