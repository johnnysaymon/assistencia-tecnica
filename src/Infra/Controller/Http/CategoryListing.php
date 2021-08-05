<?php

declare(strict_types=1);

namespace App\Infra\Controller\Http;

use App\Infra\Controller\Http\Controller;
use App\Domain\Repository\CategoryRepository;
use App\Infra\Presenter\CategoryListingApi;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class CategoryListing implements Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $CategoryRepository
    ) {
        $this->categoryRepository = $CategoryRepository;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $categoryCollection = $this->categoryRepository->findAll();

        $presenter = new CategoryListingApi();
        $presenter->setCategoryCollection($categoryCollection);

        return $presenter->make($response);
    }
}