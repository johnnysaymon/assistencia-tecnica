<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\AttributeCollection;
use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\Name;

final class Generic implements Item
{
    private AttributeCollection $attributeCollection;
    private string $categoryId;
    private Name $name;

    public function __construct(
        Name $name,
        AttributeCollection $attributeCollection,
        string $categoryId
    ) {
        $this->attributeCollection = $attributeCollection;
        $this->categoryId = $categoryId;
        $this->name = $name;
    }

    public function getAttributeCollection(): AttributeCollection
    {
        return $this->attributeCollection;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getName(): Name
    {
        return $this->name;
    }
}