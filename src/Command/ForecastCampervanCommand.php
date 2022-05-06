<?php

namespace App\Command;

use App\Entity\CampervanOrderForecast;
use App\Repository\CampervanOrderForecastRepository;
use App\Repository\OrderRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'forecast-campervan',
    description: 'Parse date and try to forecast need for this date.',
)]
class ForecastCampervanCommand extends Command
{
    public function __construct(
        protected OrderRepository $orderRepository
    ) {
        parent::__construct('forecast-campervan');
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'date',
                InputArgument::REQUIRED,
                'Please provide a date in format Y-m-d'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $date = \DateTime::createFromFormat('Y-m-d', $input->getArgument('date'));

        if ($date) {
            $io->note(sprintf('You passed an argument: %s | %s', $date->format('Y-m-d'), $date->format('n-j')));
        }

        $result = $this->orderRepository->countNumberOfOrdersForAllPeriod($date);
        var_dump($result);


        return Command::SUCCESS;
    }
}
