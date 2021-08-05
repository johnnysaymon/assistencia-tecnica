<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateItem;

use App\Domain\Entity\Item\AttributeValue;
use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\ItemName;
use App\Domain\Entity\Item\ItemFactory;
use App\Domain\Repository\ItemRepository;
use App\Domain\UseCase\CreateItem\DataInput;
use App\Domain\UseCase\CreateItem\Output;

final class Service
{
    private DataInput $dataInput;
    private string $id;
    private ItemRepository $itemRepository;
    private bool $status;

    public function __construct(
        ItemRepository $itemRepository
    ) {
        $this->id = '';
        $this->itemRepository = $itemRepository;
        $this->status = true;
    }

    public function run(DataInput $dataInput): Output
    {
        $this->dataInput = $dataInput;

        $this->validate();

        if ($this->status) {
            $item = $this->createItem();
            $this->store($item);
            $this->id = $item->getId();
        }

        return new Output(
            $this->status,
            $this->id
        );
    }

    private function validate(): void
    {
        $this->validateName();
        $this->validateAttributeList();
    }

    private function validateName(): void
    {
        if (! ItemName::isValid($this->dataInput->name)) {
            $this->status = false;
        }
    }

    private function validateAttributeList(): void
    {
        foreach ($this->dataInput->attributeList as $attribute) {
            if (! AttributeValue::isValid($attribute['value'] ?? '')) {
                $this->status = false;
                return;
            }
        }
    }

    private function createItem(): Item
    {
        return ItemFactory::create(
            $this->dataInput->name,
            $this->dataInput->categoryId,
            $this->dataInput->attributeList
        );
    }

    private function store(Item $item): void
    {
        $this->itemRepository->store($item);
    }
}