<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\ItemCollection;
use Exception;

interface ItemRepository
{
    /**
     * @throws Exception
     */
    public function findByCategoryId(string $categoryId): ItemCollection;

    /**
     * @throws Exception
     */
    public function store(Item $item): void;
}