<?php

declare(strict_types=1);

namespace App\Infra\Presenter;

use App\Domain\UseCase\CreateItem\Output;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

use function json_encode;

final class ItemStoreResultApi
{
    private Output $output;

    public function setOutput(Output $output): self
    {
        $this->output = $output;
        return $this;
    }

    public function make(Response $response): Response
    {
        if (empty($this->output)) {
            throw new Exception('No output in item store', 1);
        }

        $response = $response
            ->withStatus($this->getStatus())
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        $response->getBody()->write(
            $this->generateJson()
        );

        return $response;
    }

    private function getStatus(): int
    {
        return $this->output->getStatus() ? 201 : 422;
    }

    private function generateJson(): string
    {
        return json_encode([
            'status' => $this->output->getStatus(),
            'id' =>  $this->output->getId() 
        ]);
    }
}