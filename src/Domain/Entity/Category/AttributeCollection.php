<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\Attribute;
use Iterable\Iterator;

final class AttributeCollection extends Iterator
{
    public function __construct(Attribute ...$attributeList)
    {
        parent::__construct($attributeList);
    }

    public function findByCategoryId(string $id): AttributeCollection
    {
        $attributeList = [];

        foreach ($this as $attribute) {
            if ($attribute->getCategoryId() === $id) {
                $attributeList[] = $attribute;
            }
        }

        return new AttributeCollection(...$attributeList);
    }
}