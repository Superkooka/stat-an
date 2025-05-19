<?php

declare(strict_types=1);

namespace App\Infrastructure\CommandBus;

interface CommandBusCaller
{
    public function callCommandBus(object $request): mixed;
}
