<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Entity\Category\AttributeCollection;
use App\Domain\Entity\Category\Category;
use App\Domain\Entity\Category\CategoryCollection;
use App\Domain\Repository\CategoryRepository;
use PDO;
use PDOException;

final class CategoryPdo implements CategoryRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): CategoryCollection
    {
        return new CategoryCollection();
    }

    /**
     * @throws PDOException
     */
    public function store(Category $category): void
    {
        $sql = <<<SQL
            INSERT INTO `category` (
                `id`, `name`
            ) VALUES (
                :id,
                :name
            );
        SQL;

        $this->pdo->beginTransaction();
        
        $statement = $this->pdo->prepare($sql);
        
        $statement->bindValue(':id', $category->getId(), PDO::PARAM_STR);
        $statement->bindValue(':name', $category->getName(), PDO::PARAM_STR);
        
        $statement->execute();

        $this->storeAttributeCollection(
            $category->getId(),
            $category->getAttributeCollection()
        );

        $this->pdo->commit();
    }

    private function storeAttributeCollection(
        string $categoryId, 
        AttributeCollection $attributeCollection
    ): void {
        $sql = <<<SQL
            INSERT INTO `category_attribute` (
                `id`, `category_id`, `name`
            ) VALUES (
                :id,
                :categoryId,
                :name
            );
        SQL;

        $id = '';
        $name = '';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);

        foreach ($attributeCollection as $attribute) {
            $id = $attribute->getId();
            $name = $attribute->getName();

            $statement->execute();
        }
    }
}