<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Application\Post\Query\FindPostQuery;
use App\Core\Application\Post\Query\GetPostsQuery;
use App\Shared\Paginator\Paginator;
use Symfony\Component\HttpFoundation\Request;

final class PostQueryFactory implements PostQueryFactoryInterface
{
    public function createGetPostsQueryFromRequest(Request $request): GetPostsQuery
    {
        return new GetPostsQuery(
            params: $request->query->all(),
            page: $request->get('page') ? (int) $request->get('page') : Paginator::PAGINATOR_DEFAULT_PAGE,
            limit: $request->get('limit') ? (int) $request->get('limit') : Paginator::PAGINATOR_DEFAULT_LIMIT
        );
    }

    public function createFindPostQueryFromRequest(Request $request): FindPostQuery
    {
        return new FindPostQuery(
            uuid: $request->get('uuid')
        );
    }
}
