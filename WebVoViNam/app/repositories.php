<?php

declare(strict_types=1);

use App\Domain\User\UserRepository;
use App\Domain\Judge\JudgeRepository;
use App\Infrastructure\Persistence\Judge\JudgeService;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        JudgeRepository::class => \DI\autowire(JudgeService::class),
    ]);
};
