<?php

declare(strict_types=1);

namespace App\Infra\Presenter;

use App\Domain\Entity\Category\CategoryCollection;
use Psr\Http\Message\ResponseInterface as Response;

use function json_encode;

final class CategoryListingApi
{
    private CategoryCollection $categoryCollection;

    public function setCategoryCollection(CategoryCollection $categoryCollection): self
    {
        $this->categoryCollection = $categoryCollection;
        return $this;
    }

    public function make(Response $response): Response
    {
        $response = $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        $response->getBody()->write(
            $this->generateJson()
        );

        return $response;
    }

    private function generateJson(): string
    {
        $data = [];

        foreach ($this->categoryCollection as $category) {
            $attributeList = [];

            foreach ($category->getAttributeCollection() as $attribute) {
                $attributeList[] = [
                    'id' => $attribute->getId(),
                    'name' => $attribute->getName()->getValue()
                ];
            }

            $data[] = [
                'id' => $category->getId(),
                'name' => $category->getName()->getValue(),
                'attributeList' => $attributeList
            ];
        }

        return json_encode([
            'list' => $data
        ]);
    }
}