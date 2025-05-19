<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Infrastructure\CommandBus\CommandBusCaller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AController extends AbstractController
{
    public function __construct(
        private readonly CommandBusCaller $commandBusCaller,
    ) {
    }

    protected function callCommandBus(object $request): mixed
    {
        return $this->commandBusCaller->callCommandBus($request);
    }
}
