<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Entity\Category\Attribute;
use App\Domain\Entity\Category\AttributeCollection;
use App\Domain\Entity\Category\AttributeName;
use App\Domain\Entity\Category\Category;
use App\Domain\Entity\Category\CategoryName;
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
        $sql = <<<SQL
            SELECT 
                `id`, `name`
            FROM 
                `category`;
        SQL;

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        $categoryDataList = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (empty($categoryDataList)) {
            new CategoryCollection();
        }

        $categoryIdList = array_column($categoryDataList, 'id');

        $attributeCollection = $this->findAttributeAll(...$categoryIdList);

        foreach ($categoryDataList as $data) {
            $category = new Category(
                new CategoryName($data['name']),
                $data['id']
            );

            $category->setAttributeCollection(
                $attributeCollection->findByCategoryId($data['id'])
            );

            $categoryList[] = $category;
        }

        return new CategoryCollection(...$categoryList);
    }

    private function findAttributeAll(string ...$categoryId): AttributeCollection
    {
        $param = implode(',', array_fill(0, count($categoryId), '?'));

        $sql = <<<SQL
            SELECT 
                `id`, `name`, `category_id`
            FROM 
                `category_attribute`
            WHERE
                `category_id` IN ($param);
        SQL;

        $statement = $this->pdo->prepare($sql);
        $statement->execute($categoryId);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $attributeList = [];

        while ($data = $statement->fetch()) {
            $attributeList[] = new Attribute(
                new AttributeName($data['name']),
                $data['category_id'],
                $data['id']
            );
        }

        return new AttributeCollection(...$attributeList);
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