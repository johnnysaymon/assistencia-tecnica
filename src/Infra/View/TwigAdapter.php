<?php

declare(strict_types=1);

namespace App\Infra\View;

use App\Infra\View\ViewEngine;
use Exception;
use Twig\Environment as TwigEnvironment;

final class TwigAdapter implements ViewEngine
{
    private array $parameters;
    private TwigEnvironment $twigEnvironment;
    private string $view;

    public function __construct(TwigEnvironment $twig)
    {
        $this->twigEnvironment = $twig;
        $this->parameters = [];
        $this->view = '';
    }

    public function addParameter(string $key, $value): self
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    public function make(): string
    {
        if (empty($this->view)) {
            throw new Exception('Undefined View');
        }

        return $this->twigEnvironment->render(
            $this->view,
            $this->parameters
        );
    }

    public function setView(string $view): self
    {
        $this->view = $view;
        return $this;
    }
}