<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\Attribute;
use Iterable\Iterator;

final class AttributeCollection extends Iterator
{
    public function __construct(Attribute ...$attributeList)
    {
        parent::__construct($attributeList);
    }
}