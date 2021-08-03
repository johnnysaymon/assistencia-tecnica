<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\AttributeCollection;
use App\Domain\Entity\Category\CategoryName;

final class Category
{
    private AttributeCollection $attributeCollection;
    private CategoryName $name;

    public function __construct(
        CategoryName $name,
        AttributeCollection $attributeCollection
    ) {
        $this->attributeCollection = $attributeCollection;
        $this->name = $name;
    }

    public function getAttributeCollection(): AttributeCollection 
    {
        return $this->attributeCollection;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }
}