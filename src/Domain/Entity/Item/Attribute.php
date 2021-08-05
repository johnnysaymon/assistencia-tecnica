<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\AttributeValue;
use JsonSerializable;

final class Attribute implements JsonSerializable
{
    private string $categoryAttributeId;
    private AttributeValue $value;

    public function __construct(string $categoryAttributeId, AttributeValue $value)
    {
        $this->categoryAttributeId = $categoryAttributeId;
        $this->value = $value;
    }

    public function getCategoryAttributeId(): string
    {
        return $this->categoryAttributeId;
    }

    public function getValue(): AttributeValue
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'categoryAttributeId' => $this->getCategoryAttributeId(),
            'value' => $this->getValue()->getValue()
        ];
    }
}