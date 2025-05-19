<?php

namespace App\Application\NationalAssemblyDTO;

use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Attribute\SerializedPath;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

readonly class Seance
{
    public function __construct(
        #[SerializedPath('[metadonnees][dateSeance]')]
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHisv'])]
        public \DateTimeImmutable $dateSeance,
        #[SerializedPath('[metadonnees][legislature]')]
        public int $legislature,
        #[SerializedPath('[metadonnees][session]')]
        public string $session,
    ) {

    }
}