<?php

declare(strict_types=1);

namespace App\Domain\Post\Factory;

use App\Domain\Post\Query\FindPostQuery;
use App\Domain\Post\Query\GetPostsQuery;
use App\Shared\Paginator\Paginator;
use Symfony\Component\HttpFoundation\Request;

final class PostQueryFactory
{
    public function createGetPostsQueryFromRequest(Request $request): GetPostsQuery
    {
        return new GetPostsQuery(
            $request->query->all(),
            $request->get('page') ? (int) $request->get('page') : Paginator::PAGINATOR_DEFAULT_PAGE,
            $request->get('limit') ? (int) $request->get('limit') : Paginator::PAGINATOR_DEFAULT_LIMIT
        );
    }

    public function createFindPostQueryFromRequest(Request $request): FindPostQuery
    {
        return new FindPostQuery(
            uuid: $request->get('uuid')
        );
    }
}
