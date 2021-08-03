<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Category\AttributeCollection;
use App\Domain\Entity\Item\Item;

final class Generic implements Item
{
    private AttributeCollection $attributeCollection;
    private string $name;

    public function getAttributeCollection(): AttributeCollection
    {
        return $this->attributeCollection;
    }

    public function getName(): string
    {
        return $this->name;
    }
}