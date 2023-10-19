<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Application\Post\Query\FindPostQuery;
use App\Core\Application\Post\Query\GetPostsQuery;
use Symfony\Component\HttpFoundation\Request;

interface PostQueryFactoryInterface
{
    public function createGetPostsQueryFromRequest(Request $request): GetPostsQuery;

    public function createFindPostQueryFromRequest(Request $request): FindPostQuery;
}
