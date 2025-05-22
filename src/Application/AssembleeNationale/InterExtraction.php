<?php

declare(strict_types=1);

namespace App\Application\AssembleeNationale;

use Symfony\Component\Serializer\Attribute\SerializedPath;

readonly class InterExtraction
{
    public function __construct(
        #[SerializedPath('[@nom_orateur]')]
        public string $nomOrateur,
        #[SerializedPath('[@id_acteur]')]
        public string $idActeur,
        #[SerializedPath('[@id_nomination_oe]')]
        public int $idNominationOe,
        #[SerializedPath('[@id_nomination_op]')]
        public int $idNominationOp,
        #[SerializedPath('[@id_mandat]')]
        public string $idMandat,
        #[SerializedPath('[@qualite]')]
        public ?string $qualite,
        #[SerializedPath('[paragraphe]')]
        /** @var ?Paragraphe[] $paragraphes */
        public ?array $paragraphes,
    ) {
    }
}
