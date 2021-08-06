<?php

declare(strict_types=1);

namespace App\Infra\Controller\Http;

use App\Infra\Controller\Http\Controller;
use App\Infra\View\ViewEngine;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

abstract class PageStatic implements Controller
{
    private ViewEngine $viewEngine;

    public function __construct(
        ViewEngine $viewEngine
    ) {
        $this->viewEngine = $viewEngine;
    }

    public abstract function getPathView(): string;

    public function __invoke(Request $request, Response $response): Response
    {
        $this->viewEngine->setView($this->getPathView());

        $response->getBody()->write(
            $this->viewEngine->make()
        );

        return $response;
    }
}