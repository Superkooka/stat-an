<?php

declare(strict_types=1);

namespace App\Application\AssembleeNationale;

use Symfony\Component\Serializer\Attribute\SerializedPath;

readonly class Point
{
    public function __construct(
        #[SerializedPath('[texte]')]
        public string|array|null $texte,
        #[SerializedPath('[@nivpoint]')]
        public int $nivPoint,
        #[SerializedPath('[@structure]')]
        public ?string $structure,
        #[SerializedPath('[point]')]
        /** @var ?Point[] $points */
        public ?array $points,
        #[SerializedPath('[paragraphe]')]
        /** @var ?Paragraphe[] $paragraphes */
        public ?array $paragraphes,
        #[SerializedPath('[interExtraction]')]
        /** @var ?InterExtraction[] $interExtraction */
        public ?array $interExtraction,
    ) {
    }
}
