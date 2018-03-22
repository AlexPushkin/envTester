<?php
declare(strict_types=1);

namespace pushka\environmentTester;

use PDO;
use PDOException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MySqlTestCommand extends Command
{
    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this->setName('test:mysql')
            ->setDescription('Mysql connection test command')
            ->addArgument('host', InputArgument::REQUIRED, 'Mysql host name')
            ->addArgument('db', InputArgument::REQUIRED, 'Mysql database name')
            ->addArgument('user', InputArgument::REQUIRED, 'Mysql user name')
            ->addArgument('pass', InputArgument::REQUIRED, 'Mysql user password');

    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            new PDO(
                "mysql:host={$input->getArgument('host')};dbname={$input->getArgument('db')};",
                $input->getArgument('user'),
                $input->getArgument('pass'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]
            );
            $output->writeln('<info>=== Mysql connection established ===</info>');
        } catch (PDOException $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");
        }
    }
}