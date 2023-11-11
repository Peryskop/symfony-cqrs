<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Query\FindPostQuery;
use App\Post\Application\Query\FindPostQueryInterface;
use App\Post\Application\Query\GetPostsQuery;
use App\Post\Application\Query\GetPostsQueryInterface;
use App\Shared\DataCollector\DataExtractorInterface;
use App\Shared\Paginator\PaginatorInterface;

final readonly class PostQueryFactory implements PostQueryFactoryInterface
{
    /** @var mixed[] $data */
    private array $data;

    public function __construct(
        private DataExtractorInterface $dataCollector
    ) {
        $this->data = $this->dataCollector->collect();
    }

    public function createGetPostsQuery(): GetPostsQueryInterface
    {
        return new GetPostsQuery(
            params: $this->data['params'],
            page: intval($this->data['params']['page'] ?? PaginatorInterface::PAGINATOR_DEFAULT_PAGE),
            limit: intval($this->data['params']['limit'] ?? PaginatorInterface::PAGINATOR_DEFAULT_LIMIT)
        );
    }

    public function createFindPostQuery(): FindPostQueryInterface
    {
        return new FindPostQuery(
            uuid: $this->data['uuid']
        );
    }
}
