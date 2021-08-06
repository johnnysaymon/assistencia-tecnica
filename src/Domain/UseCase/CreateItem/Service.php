<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateItem;

use App\Domain\Entity\Category\Category;
use App\Domain\Entity\Item\AttributeValue;
use App\Domain\Entity\Item\Item;
use App\Domain\Entity\Item\ItemName;
use App\Domain\Entity\Item\ItemFactory;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Repository\ItemRepository;
use App\Domain\UseCase\CreateItem\DataInput;
use App\Domain\UseCase\CreateItem\Output;

final class Service
{
    private ?Category $category;
    private CategoryRepository $categoryRepository;
    private DataInput $dataInput;
    private string $id;
    private ItemRepository $itemRepository;
    private bool $status;

    public function __construct(
        ItemRepository $itemRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->id = '';
        $this->itemRepository = $itemRepository;
        $this->status = true;
    }

    public function run(DataInput $dataInput): Output
    {
        $this->dataInput = $dataInput;

        $this->category = $this->findCategory();
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

    private function findCategory(): ?Category
    {
        return $this->categoryRepository->findById($this->dataInput->categoryId);
    }

    private function validate(): void
    {
        $this->validateCategory();
        $this->validateName();
        $this->validateAttributeList();
    }

    private function validateCategory(): void
    {
        if (empty($this->category)) {
            $this->status = false;
            return;
        }
    }

    private function validateName(): void
    {
        if (! ItemName::isValid($this->dataInput->name)) {
            $this->status = false;
        }
    }

    private function validateAttributeList(): void
    {
        if (empty($this->category)) {
            return;
        }

        $categoryAttributeCollection = $this->category->getAttributeCollection();
        $categoryAttributeIdList = array_unique(
            array_column($this->dataInput->attributeList, 'categoryAttributeId')
        );

        if (count($categoryAttributeIdList) != count($categoryAttributeCollection)) {
            $this->status = false;
            return;
        }

        foreach ($this->dataInput->attributeList as $attribute) {
            if (! AttributeValue::isValid($attribute['value'] ?? '')) {
                $this->status = false;
                return;
            }

            if (! $categoryAttributeCollection->hasId($attribute['categoryAttributeId']) ) {
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