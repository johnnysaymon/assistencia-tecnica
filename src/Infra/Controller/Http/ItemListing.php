<?php

declare(strict_types=1);

namespace App\Infra\Controller\Http;

use App\Infra\Controller\Http\Controller;
use App\Domain\Repository\ItemRepository;
use App\Infra\Presenter\ItemListingApi;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ItemListing implements Controller
{
    private Request $request;
    private ItemRepository $itemRepository;

    public function __construct(
        ItemRepository $itemRepository
    ) {
        $this->itemRepository = $itemRepository;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $this->request = $request;
        $categoryId = $this->getCategoryId();
        $itemCollection = $this->itemRepository->findByCategoryId($categoryId);

        $presenter = new ItemListingApi();
        $presenter->setItemCollection($itemCollection);

        return $presenter->make($response);
    }

    private function getCategoryId(): string
    {
        $path = $this->request->getUri()->getPath();
        $pattern = '/categorias\/([\d\w\-]+)\/itens\/$/';

        if (! preg_match($pattern, $path, $match)) {
            throw new Exception("ID Category undefined", 1);
        }

        return $match[1];
    }
}