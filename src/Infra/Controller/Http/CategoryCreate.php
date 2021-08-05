<?php

declare(strict_types=1);

namespace App\Infra\Controller\Http;

use App\Domain\UseCase\CreateCategory\DataInput;
use App\Domain\UseCase\CreateCategory\Service as CreateCategoryUseCase;
use App\Infra\Controller\Http\Controller;
use App\Infra\Presenter\CategoryStoreResultApi;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class CategoryCreate implements Controller
{
    private CreateCategoryUseCase $createCategoryUseCase;
    private Request $request;

    public function __construct(
        CreateCategoryUseCase $createCategoryUseCase
    ) {
        $this->createCategoryUseCase = $createCategoryUseCase;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $this->request = $request;

        $dataInput = $this->createDataInput();
        $output = $this->createCategoryUseCase->run($dataInput);

        $presenter = new CategoryStoreResultApi();
        $presenter->setOutput($output);

        return $presenter->make($response);
    }

    private function createDataInput(): DataInput
    {
        $dataRequest = json_decode($this->request->getBody()->getContents(), true);
        return DataInput::createFromArray($dataRequest);
    }
}