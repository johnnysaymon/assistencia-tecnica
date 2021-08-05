<?php

declare(strict_types=1);

use App\Infra\Container\Factory as ContainerFactory;
use App\Infra\Controller\Http\CategoryCreate;
use Psr\Container\ContainerInterface;
use Slim\App;

/** @var  ContainerInterface */
$container = ContainerFactory::create();

/** @var App */
$app = $container->get(App::class);

$app->post('/categoria/', CategoryCreate::class);

$app->run();