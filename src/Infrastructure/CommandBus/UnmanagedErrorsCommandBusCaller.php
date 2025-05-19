<?php

declare(strict_types=1);

namespace App\Infrastructure\CommandBus;

use League\Tactician\CommandBus;

readonly class UnmanagedErrorsCommandBusCaller implements CommandBusCaller
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    public function callCommandBus(object $request): mixed
    {
        return $this->commandBus->handle($request);
    }
}
