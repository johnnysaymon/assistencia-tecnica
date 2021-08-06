<?php

declare(strict_types=1);

namespace App\Infra\Controller\Http;

use App\Domain\UseCase\CreateItem\DataInput;
use App\Domain\UseCase\CreateItem\Service as CreateItemUseCase;
use App\Infra\Controller\Http\Controller;
use App\Infra\Presenter\ItemStoreResultApi;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ItemCreate implements Controller
{
    private CreateItemUseCase $createItemUseCase;
    private Request $request;

    public function __construct(
        CreateItemUseCase $createItemUseCase
    ) {
        $this->createItemUseCase = $createItemUseCase;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $this->request = $request;

        $dataInput = $this->createDataInput();
        $output = $this->createItemUseCase->run($dataInput);

        $presenter = new ItemStoreResultApi();
        $presenter->setOutput($output);

        return $presenter->make($response);
    }

    private function createDataInput(): DataInput
    {
        $dataRequest = json_decode($this->request->getBody()->getContents(), true);
        $dataRequest['categoryId'] = $this->getCategoryId();
        return DataInput::createFromArray($dataRequest);
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