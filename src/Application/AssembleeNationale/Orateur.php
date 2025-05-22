<?php

declare(strict_types=1);

namespace App\Application\AssembleeNationale;

use Symfony\Component\Serializer\Attribute\SerializedPath;

readonly class Orateur
{
    public function __construct(
        #[SerializedPath('[nom]')]
        public string $nom,
        #[SerializedPath('[id]')]
        public string $id,
        #[SerializedPath('[qualite]')]
        public string $qualite,
    ) {
    }
}
