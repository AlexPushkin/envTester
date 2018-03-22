#!/usr/bin/env php
<?php
declare(strict_types=1);

use pushka\environmentTester\ElasticTestCommand;
use pushka\environmentTester\MySqlTestCommand;
use pushka\environmentTester\RabbitTestCommand;
use pushka\environmentTester\RedisTestCommand;
use Symfony\Component\Console\Application;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$app = new Application('Environment tester');

$app->add(new MySqlTestCommand());
$app->add(new RedisTestCommand());
$app->add(new RabbitTestCommand());
$app->add(new ElasticTestCommand());

$app->run();
