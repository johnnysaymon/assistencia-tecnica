<?php

declare(strict_types=1);

namespace App\Infra\View;

interface ViewEngine
{
    public function addParameter(string $key, $value): self;

    public function make(): string;

    public function setView(string $view): self;
}