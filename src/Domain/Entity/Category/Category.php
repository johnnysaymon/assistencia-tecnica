<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\AttributeCollection;

final class Category
{
    private AttributeCollection $attributeCollection;
    private string $name;

    public function __construct(
        string $name,
        AttributeCollection $attributeCollection
    ) {
        $this->name = $name;
        $this->attributeCollection = $attributeCollection;
    }

    public function getAttributeCollection(): AttributeCollection 
    {
        return $this->attributeCollection;
    }

    public function getName(): string 
    {
        return $this->name;
    }
}