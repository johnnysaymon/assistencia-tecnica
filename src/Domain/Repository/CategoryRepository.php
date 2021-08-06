<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Category\Category;
use App\Domain\Entity\Category\CategoryCollection;
use Exception;

interface CategoryRepository
{
    /**
     * @throws Exception
     */
    public function findAll(): CategoryCollection;

    /**
     * @throws Exception
     */
    public function findById(string $id): ?Category;

    /**
     * @throws Exception
     */
    public function store(Category $category): void;
}