<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\Category;
use Iterable\Iterator;

final class CategoryCollection extends Iterator
{
    public function __construct(Category ...$categoryList)
    {
        parent::__construct($categoryList);
    }
}