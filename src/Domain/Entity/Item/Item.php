<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Category\AttributeCollection;

interface Item
{
    public function getAttributeCollection(): AttributeCollection;

    public function getName(): string;
}