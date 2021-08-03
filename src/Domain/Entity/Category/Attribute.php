<?php

declare(strict_types=1);

namespace App\Domain\Entity\Category;

use App\Domain\Entity\Category\AttributeName;

final class Attribute
{
    private AttributeName $name;

    public function __construct(AttributeName $name)
    {
        $this->name = $name;
    }

    public function getName(): AttributeName
    {
        return $this->name;
    }
}