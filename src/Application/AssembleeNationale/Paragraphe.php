<?php

declare(strict_types=1);

namespace App\Application\AssembleeNationale;

use Symfony\Component\Serializer\Attribute\SerializedPath;

readonly class Paragraphe
{
    public function __construct(
        #[SerializedPath('[orateurs]')]
        public ?array $orateur,
        public array|string $texte,
        #[SerializedPath('[@ordre_absolu_seance]')]
        public int $ordreAbsoluteSeance,
        #[SerializedPath('[@code_grammaire]')]
        public string $codeGrammaire,
        #[SerializedPath('[@code_style]')]
        public string $codeStyle,
        #[SerializedPath('[@code_parole]')]
        public string $codeParole,
        #[SerializedPath('[@id_acteur]')]
        public null|string $idActeur,
        #[SerializedPath('[@id_mandat]')]
        public null|string|int $idMandat,
        #[SerializedPath('[@id_nomination_oe]')]
        public null|string|int $idNominationOe,
        #[SerializedPath('[@id_nomination_op]')]
        public null|string|int $idNominationOp,
        #[SerializedPath('[@art]')]
        public ?int $art,
        #[SerializedPath('[@adt]')]
        public ?int $adt,

        /** @var ?Paragraphe[] $paragraphes */
        public ?array $paragraphes,
    ) {
    }
}
