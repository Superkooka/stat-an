<?php

namespace App\Infrastructure\Console;

use App\Application\UseCase\DeserializeCompteRenduANRequest;
use App\Infrastructure\CommandBus\CommandBusCaller;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('stat-an:debug:deserialize:compte-rendu')]
class DebugDeserializeCompteRendu extends Command
{
    public function __construct(
        private readonly CommandBusCaller $commandBusCaller,
    )
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $compteRendu = $this->commandBusCaller->callCommandBus(new DeserializeCompteRenduANRequest(__DIR__ . '/../../../samples/CRSANR5L17S2025O1N201.xml'));
        dd($compteRendu);

        return Command::SUCCESS;
    }
}