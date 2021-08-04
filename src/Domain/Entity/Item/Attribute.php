<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

final class Attribute
{
    private string $categoryAttributeId;
    private string $value;

    public function __construct(string $categoryAttributeId, string $value)
    {
        $this->categoryAttributeId = $categoryAttributeId;
        $this->value = $value;
    }

    public function getCategoryAttributeId(): string
    {
        return $this->categoryAttributeId;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}