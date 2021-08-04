<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateCategory;

final class Output
{
    private string $id;
    private bool $status;

    public function __construct(
        bool $status,
        string $id
    ) {
        $this->id = $id;
        $this->status = $status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}