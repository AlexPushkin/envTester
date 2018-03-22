<?php
declare(strict_types=1);

namespace pushka\environmentTester;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RabbitTestCommand extends Command
{
    protected function configure()
    {
        $this->setName('test:rabbit')
            ->setDescription('Rabbit test command')
            ->addArgument('host', InputArgument::REQUIRED, 'Rabbit hostname')
            ->addArgument('port', InputArgument::REQUIRED, 'Rabbit port')
            ->addArgument('name', InputArgument::REQUIRED, 'Rabbit user name')
            ->addArgument('pass', InputArgument::REQUIRED, 'Rabbit user password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            new AMQPStreamConnection(
                $input->getArgument('host'),
                $input->getArgument('port'),
                $input->getArgument('name'),
                $input->getArgument('pass')
            );
            $output->writeln('<info>=== RabbitMq connection established ===</info>');
        } catch (\ErrorException $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");
        }
    }


}