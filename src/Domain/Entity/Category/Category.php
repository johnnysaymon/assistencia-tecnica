<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\AttributeCollection;
use App\Domain\Entity\Category\CategoryName;

use function uniqid;

final class Category
{
    private const ID_PREFIX = 'categ';

    private AttributeCollection $attributeCollection;
    private string $id;
    private CategoryName $name;

    public function __construct(
        CategoryName $name,
        AttributeCollection $attributeCollection
    ) {
        $this->attributeCollection = $attributeCollection;
        $this->id = uniqid(self::ID_PREFIX);
        $this->name = $name;
    }

    public function getAttributeCollection(): AttributeCollection 
    {
        return $this->attributeCollection;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }
}