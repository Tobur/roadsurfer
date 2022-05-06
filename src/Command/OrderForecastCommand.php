<?php

namespace App\Command;

use App\Entity\OrderForecast;
use App\Service\OrderHistoricalForecast;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'order-forecast',
    description: 'Parse date and try to forecast need for this date.',
)]
class OrderForecastCommand extends Command
{
    public function __construct(
        protected OrderHistoricalForecast $orderHistoricalForecast
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

        $today = new \DateTime();
        $today->modify('+1 years');

        if ($today->getTimestamp() < $date->getTimestamp()) {
            throw new \InvalidArgumentException('Prediction limited by one year.');
        }

        if ($date) {
            $io->note(sprintf('You passed an argument: %s | %s', $date->format('Y-m-d'), $date->format('n-j')));
        }

        $result = $this->orderHistoricalForecast->forecastForASingleDay($date);
        /** @var OrderForecast $orderForecast */
        foreach ($result as $orderForecast) {
            $output->writeln('');
            $output->writeln(sprintf('For station: %s', $orderForecast->getStation()->getName()));
            $output->writeln(sprintf('Forecast %s number of campers', $orderForecast->getExpectedAmount()));
            $output->writeln('');
        }

        return Command::SUCCESS;
    }
}
