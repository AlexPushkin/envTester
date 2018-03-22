<?php
declare(strict_types=1);

namespace pushka\environmentTester;

use Predis\Client;
use Predis\Connection\ConnectionException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RedisTestCommand extends Command
{
    protected function configure()
    {
        $this->setName('test:redis')
            ->setDescription('Redis test command')
            ->addArgument('host', InputArgument::REQUIRED, 'Redis hostname')
            ->addArgument('port', InputArgument::REQUIRED, 'Redis port');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $redis = new Client([
                'scheme' => 'tcp',
                'host' => $input->getArgument('host'),
                'port' => $input->getArgument('port'),
            ]);
            $redis->set('test-key', '<info>=== Connection established ===</info>');
            $output->writeln($redis->get('test-key'));
        } catch (ConnectionException $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");
        }
    }
}