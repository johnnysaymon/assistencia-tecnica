<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateCategory;

final class DataInput
{
    /** @var array<string> */
    public array $attributeList = [];
    public string $name = '';
}