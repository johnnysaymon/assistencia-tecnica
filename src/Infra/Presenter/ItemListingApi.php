<?php

declare(strict_types=1);

namespace App\Infra\Presenter;

use App\Domain\Entity\Item\ItemCollection;
use Psr\Http\Message\ResponseInterface as Response;

use function json_encode;

final class ItemListingApi
{
    private ItemCollection $itemCollection;

    public function setItemCollection(ItemCollection $itemCollection): self
    {
        $this->itemCollection = $itemCollection;
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

        foreach ($this->itemCollection as $item) {
            $attributeList = [];

            foreach ($item->getAttributeCollection() as $attribute) {
                $attributeList[] = [
                    'categoryAttributeId' => $attribute->getCategoryAttributeId(),
                    'value' => $attribute->getValue()->getValue()
                ];
            }

            $data[] = [
                'id' => $item->getId(),
                'name' => $item->getName()->getValue(),
                'categoryId' => $item->getCategoryId(),
                'attributeList' => $attributeList
            ];
        }

        return json_encode([
            'list' => $data
        ]);
    }
}