<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Entity\Item\Attribute;
use App\Domain\Entity\Item\AttributeCollection;
use App\Domain\Entity\Item\AttributeValue;
use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\ItemName;
use App\Domain\Entity\Item\ItemCollection;
use App\Domain\Entity\Item\ItemGeneric;
use App\Domain\Repository\ItemRepository;
use PDO;
use PDOException;

final class ItemPdo implements ItemRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByCategoryId(string $categoryId): ItemCollection
    {
        $sql = <<<SQL
            SELECT 
                `id`, `name`, `category_id`, `attribute_list`
            FROM 
                `item`
            WHERE
                `category_id` = :categoryId;
        SQL;

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $itemList = [];

        while ($itemData = $statement->fetch()) {
            $attributeList = array_map(
                fn($attributeData) => new Attribute(
                    $attributeData['categoryAttributeId'], 
                    new AttributeValue($attributeData['value'])
                ),
                json_decode($itemData['attribute_list'], true)
            );

            $item = new ItemGeneric(
                new ItemName($itemData['name']),
                $itemData['category_id'],
                $itemData['id']
            );

            $item->setAttributeCollection(
                new AttributeCollection(...$attributeList)
            );

            $itemList[] = $item;
        }

        return new ItemCollection(...$itemList);
    }

    /**
     * @throws PDOException
     */
    public function store(Item $item): void
    {
        $sql = <<<SQL
            INSERT INTO `item` (
                `id`, `name`, `category_id`, `attribute_list`
            ) VALUES (
                :id,
                :name,
                :categoryId,
                :attributeList
            );
        SQL;
        
        $statement = $this->pdo->prepare($sql);
        
        $statement->bindValue(':id', $item->getId(), PDO::PARAM_STR);
        $statement->bindValue(':name', $item->getName(), PDO::PARAM_STR);
        $statement->bindValue(':categoryId', $item->getCategoryId(), PDO::PARAM_STR);
        $statement->bindValue(':attributeList', json_encode($item->getAttributeCollection()->getItems()), PDO::PARAM_STR);

        $statement->execute();
    }
}