<?php

use App\Domain\Repository\CategoryRepository;
use App\Infra\Repository\CategoryPdo;
use Psr\Container\ContainerInterface as Container;

return [
    CategoryRepository::class => function(Container $container): CategoryRepository
    {
        return $container->get(CategoryPdo::class);
    },
];