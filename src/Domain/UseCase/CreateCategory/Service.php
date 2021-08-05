<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateCategory;

use App\Domain\Entity\Category\AttributeName;
use App\Domain\Entity\Category\Category;
use App\Domain\Entity\Category\CategoryFactory;
use App\Domain\Entity\Category\CategoryName;
use App\Domain\Repository\CategoryRepository;
use App\Domain\UseCase\CreateCategory\DataInput;
use App\Domain\UseCase\CreateCategory\Output;

final class Service
{
    private CategoryRepository $categoryRepository;
    private DataInput $dataInput;
    private string $id;
    private bool $status;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->id = '';
        $this->status = true;
    }

    public function run(DataInput $dataInput): Output
    {
        $this->dataInput = $dataInput;

        $this->validate();

        if ($this->status) {
            $category = $this->createCategory();
            $this->store($category);
            $this->id = $category->getId();
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
        if (! CategoryName::isValid($this->dataInput->name)) {
            $this->status = false;
        }
    }

    private function validateAttributeList(): void
    {
        foreach ($this->dataInput->attributeList as $attribute) {
            if (! AttributeName::isValid($attribute['name'] ?? '')) {
                $this->status = false;
                return;
            }
        }
    }

    private function createCategory(): Category
    {
        return CategoryFactory::create(
            $this->dataInput->name,
            $this->dataInput->attributeList
        );
    }

    private function store(Category $category): void
    {
        $this->categoryRepository->store($category);
    }
}