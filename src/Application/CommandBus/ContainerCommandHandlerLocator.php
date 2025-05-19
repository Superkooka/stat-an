<?php

declare(strict_types=1);

namespace App\Application\CommandBus;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\ContainerInterface;

class ContainerCommandHandlerLocator implements HandlerLocator
{
    public function __construct(
        private readonly ContainerInterface $container
    ) {
    }

    public function getHandlerForCommand($commandName)
    {
        $commandHandler = substr($commandName, 0, -\strlen('Request'));
        if (!$this->container->has($commandHandler)) {
            throw MissingHandlerException::forCommand($commandName);
        }

        return $this->container->get($commandHandler);
    }
}
