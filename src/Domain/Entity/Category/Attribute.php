<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\AttributeName;

use function uniqid;

final class Attribute
{
    private const ID_PREFIX = 'ctg-attr-';

    private string $categoryId;
    private string $id;
    private AttributeName $name;

    public function __construct(AttributeName $name, string $categoryId, ?string $id = null)
    {
        $this->id = $id ?? uniqid(self::ID_PREFIX);
        $this->categoryId = $categoryId;
        $this->name = $name;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): AttributeName
    {
        return $this->name;
    }
}