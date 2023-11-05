<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Query\FindPostQuery;
use App\Post\Application\Query\GetPostsQuery;
use Symfony\Component\HttpFoundation\Request;

interface PostQueryFactoryInterface
{
    public function createGetPostsQueryFromRequest(Request $request): GetPostsQuery;

    public function createFindPostQueryFromRequest(Request $request): FindPostQuery;
}
