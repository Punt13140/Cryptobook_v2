<?php

namespace App\Command;

use App\Service\FiatRatesService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fiat:updateRates',
    description: 'Update fiat rates',
)]
class FiatUpdateRatesCommand extends Command
{
    public function __construct(
        private readonly FiatRatesService $fiatRatesService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->fiatRatesService->updateFiatRates();
        $io->success('Execution de fiat:updateRates terminé.');

        return Command::SUCCESS;
    }
}
