<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\AssembleeNationale\Seance;
use Symfony\Component\Serializer\SerializerInterface;

class DeserializeCompteRenduAN
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {
    }

    public function handle(DeserializeCompteRenduANRequest $request): void
    {
        $compteRenduXML = file_get_contents($request->filename);

        dd($this->serializer->deserialize($compteRenduXML, Seance::class, 'xml'));
    }
}
