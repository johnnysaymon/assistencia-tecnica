<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\Item;
use Iterable\Iterator;

final class ItemCollection extends Iterator
{
    public function __construct(Item ...$itemList)
    {
        parent::__construct($itemList);
    }
}