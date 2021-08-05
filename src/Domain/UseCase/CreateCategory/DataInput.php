<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateCategory;

final class DataInput
{
    /** @var array<string> */
    public array $attributeList = [];
    public string $name = '';

    public static function createFromArray(array $data): DataInput
    {
        $dataInput = new DataInput();
        $dataInput->name = $data['name'] ?? '';
        $dataInput->attributeList = $data['attributeList'] ?? [];

        return $dataInput;
    }
}