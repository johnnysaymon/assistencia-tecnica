<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\AttributeName;

use function uniqid;

final class Attribute
{
    private const ID_PREFIX = 'categ-attr';

    private string $id;
    private AttributeName $name;

    public function __construct(AttributeName $name)
    {
        $this->name = $name;
        $this->id = uniqid(self::ID_PREFIX);
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