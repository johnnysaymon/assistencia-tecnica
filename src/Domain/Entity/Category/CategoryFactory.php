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
        array $attributeList,
        ?string $id = null
    ): Category
    {
        $category = new Category(
            new CategoryName($name),
            $id
        );

        $attributeCollection = new AttributeCollection(
            ...array_map(function(array $attribute) use ($category) {
                return new Attribute(
                    new AttributeName($attribute['name']),
                    $category->getId()
                );
            }, $attributeList)
        );

        $category->setAttributeCollection($attributeCollection);

        return $category;
    }
}