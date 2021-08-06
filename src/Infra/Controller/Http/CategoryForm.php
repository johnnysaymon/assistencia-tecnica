<?php

declare(strict_types=1);

namespace App\Infra\Controller\Http;

use App\Infra\Controller\Http\PageStatic;

final class CategoryForm extends PageStatic
{
    public function getPathView(): string
    {
        return 'page/form-category.twig';
    }
}