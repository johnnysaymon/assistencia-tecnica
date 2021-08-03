<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Category\AttributeName;

final class Attribute
{
    private AttributeName $name;
    private string $value;

    public function __construct(AttributeName $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): AttributeName
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}