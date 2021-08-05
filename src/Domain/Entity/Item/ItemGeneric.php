<?php

declare(strict_types=1);

namespace App\Domain\Entity\Item;

use App\Domain\Entity\Item\AttributeCollection;
use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\ItemName;

final class ItemGeneric implements Item
{
    private const ID_PREFIX = 'ig-';

    private AttributeCollection $attributeCollection;
    private string $categoryId;
    private string $id;
    private ItemName $name;

    public function __construct(
        ItemName $name,
        string $categoryId,
        ?string $id = null
    ) {
        $this->attributeCollection = new AttributeCollection();
        $this->categoryId = $categoryId;
        $this->id = $id ?? uniqid(self::ID_PREFIX);
        $this->name = $name;
    }

    public function getAttributeCollection(): AttributeCollection
    {
        return $this->attributeCollection;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ItemName
    {
        return $this->name;
    }

    public function setAttributeCollection(AttributeCollection $attributeCollection): self
    {
        $this->attributeCollection = $attributeCollection;
        return $this;
    }
}