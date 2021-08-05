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
}