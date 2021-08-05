<?php

use App\Domain\Repository\CategoryRepository;
use App\Domain\Repository\ItemRepository;
use App\Infra\Repository\CategoryPdo;
use App\Infra\Repository\ItemPdo;
use Psr\Container\ContainerInterface as Container;

return [
    CategoryRepository::class => function(Container $container): CategoryRepository
    {
        return $container->get(CategoryPdo::class);
    },

    ItemRepository::class => function(Container $container): ItemRepository
    {
        return $container->get(ItemPdo::class);
    },
];