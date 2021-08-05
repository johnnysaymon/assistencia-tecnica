<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateItem;

final class DataInput
{
    /** @var list<array{categoryAttributeId: string, value: string}> */
    public array $attributeList = [];
    public string $categoryId = '';
    public string $name = '';

    public static function createFromArray(array $data): DataInput
    {
        $dataInput = new DataInput();
        $dataInput->name = $data['name'] ?? '';
        $dataInput->categoryId = $data['categoryId'] ?? '';
        $dataInput->attributeList = $data['attributeList'] ?? [];

        return $dataInput;
    }
}