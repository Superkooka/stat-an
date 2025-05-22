<?php

declare(strict_types=1);

namespace App\Application\AssembleeNationale;

use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Attribute\SerializedPath;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

readonly class Seance
{
    public function __construct(
        #[SerializedPath('[uid]')]
        public string $uid,
        #[SerializedPath('[metadonnees][dateSeance]')]
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHisv'])]
        public \DateTimeImmutable $dateSeance,
        #[SerializedPath('[metadonnees][legislature]')]
        public int $legislature,
        #[SerializedPath('[metadonnees][session]')]
        public string $session,
        #[SerializedPath('[contenu][point]')]
        /** @var Point[] $points */
        public array $points,
    ) {
    }
}
