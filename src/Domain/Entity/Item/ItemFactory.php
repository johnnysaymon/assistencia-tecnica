<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\Attribute;
use App\Domain\Entity\Item\AttributeValue;
use App\Domain\Entity\Item\AttributeCollection;
use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\ItemGeneric;
use App\Domain\Entity\Item\ItemName;

final class ItemFactory
{
    public static function create(
        string $name,
        string $categoryId,
        array $attributeList,
        ?string $id = null
    ): Item
    {
        $item = new ItemGeneric(
            new ItemName($name),
            $categoryId,
            $id
        );

        $attributeCollection = new AttributeCollection(
            ...array_map(function(array $attribute) use ($item) {
                return new Attribute(
                    $attribute['categoryAttributeId'],
                    new AttributeValue($attribute['value'])
                );
            }, $attributeList)
        );

        $item->setAttributeCollection($attributeCollection);

        return $item;
    }
}