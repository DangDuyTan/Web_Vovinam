<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Database\DB;
use App\Infrastructure\Persistence\Judge\JudgeService;
use App\Infrastructure\Persistence\Student\StudentService;


return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },

        PDO::class => function (ContainerInterface $c) {
            $db =new DB();
            return $db->connectDB();
        },
        UserRepository::class => function (ContainerInterface $c) {
            return new InMemoryUserRepository($c->get(PDO::class));
        },
        JudgeRepository::class => function (ContainerInterface $c) {
            return new JudgeService($c->get(PDO::class));
        },
        StudentRepository::class => function (ContainerInterface $c) {
            return new StudentService($c->get(PDO::class));
        },
    ]);
};
