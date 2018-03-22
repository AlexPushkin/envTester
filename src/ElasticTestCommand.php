<?php
declare(strict_types=1);

namespace pushka\environmentTester;

use Elasticsearch\ClientBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ElasticTestCommand extends Command
{
    protected function configure()
    {
        $this->setName('test:elastic')
            ->setDescription('Elastic test command')
            ->addArgument('host', InputArgument::REQUIRED, 'Elastic hostname')
            ->addArgument('port', InputArgument::REQUIRED, 'Elastic port');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $client = ClientBuilder::create()
                ->setHosts([
                    'host' => $input->getArgument('host'),
                    'port' => $input->getArgument('port'),
                ])
                ->setRetries(1)
                ->build();
            $client->info();
            $output->writeln('<info>=== Elasticsearch connection established ===</info>');
        } catch (\Exception $exception) {
            $output->writeln("<error>{$exception}</error>");
        }
    }


}