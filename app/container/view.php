<?php

use App\Infra\View\TwigAdapter;
use App\Infra\View\ViewEngine;
use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use Psr\Container\ContainerInterface as Container;

return [
    TwigEnvironment::class => function(): TwigEnvironment
    {
        $loader = new TwigFilesystemLoader(__DIR__.'/../view');

        return new TwigEnvironment(
            $loader,
            [
                'cache' => false,
            ]
        );
    },

    ViewEngine::class => function(Container $container): ViewEngine
    {
        $twigAdapter = $container->get(TwigAdapter::class);
        return $twigAdapter;
    }
];