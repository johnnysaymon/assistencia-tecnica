<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\AttributeCollection;
use App\Domain\Entity\Item\Name;

interface Item
{
    public function getAttributeCollection(): AttributeCollection;

    public function getCategoryId(): string;

    public function getName(): Name;
}