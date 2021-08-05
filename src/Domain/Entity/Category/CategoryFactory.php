<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\Attribute;
use App\Domain\Entity\Category\AttributeName;
use App\Domain\Entity\Category\AttributeCollection;
use App\Domain\Entity\Category\Category;
use App\Domain\Entity\Category\CategoryName;

final class CategoryFactory
{
    public static function create(
        string $name,
        array $attributeList
    ): Category
    {
        $attributeCollection = new AttributeCollection(
            ...array_map(function(array $attribute) {
                return new Attribute(
                    new AttributeName($attribute['name'])
                );
            }, $attributeList)
        );

        return new Category(
            new CategoryName($name),
            $attributeCollection
        );
    }
}