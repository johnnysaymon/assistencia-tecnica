<?php

declare(strict_types=1);

use App\Infra\Container\Factory as ContainerFactory;
use App\Infra\Controller\Http\Index;
use App\Infra\Controller\Http\CategoryCreate;
use App\Infra\Controller\Http\CategoryForm;
use App\Infra\Controller\Http\CategoryListingApi;
use App\Infra\Controller\Http\CategoryListingPage;
use App\Infra\Controller\Http\ItemCreate;
use App\Infra\Controller\Http\ItemListing;
use App\Infra\Handler\Error;
use App\Infra\Middleware\Environment as EnvironmentMiddleware;
use Psr\Container\ContainerInterface;
use Slim\App;

/** @var  ContainerInterface */
$container = ContainerFactory::create();

/** @var App */
$app = $container->get(App::class);

$app->addRoutingMiddleware();
$app->add(EnvironmentMiddleware::class);

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(Error::class);

$app->get('/', Index::class);

$app->get('/categorias/', CategoryListingApi::class);

$app->post('/categorias/', CategoryCreate::class);

$app->get('/categorias/{id}/itens/', ItemListing::class);

$app->get('/formularios/cadastro-de-categoria/', CategoryForm::class);

$app->post('/itens/', ItemCreate::class);

$app->get('/listagem/categorias/', CategoryListingPage::class);

$app->run();