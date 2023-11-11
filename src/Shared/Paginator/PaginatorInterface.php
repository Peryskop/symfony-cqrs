<?php

declare(strict_types=1);

namespace App\Shared\Paginator;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;

interface PaginatorInterface
{
    public const PAGINATOR_DEFAULT_PAGE = 1;

    public const PAGINATOR_DEFAULT_LIMIT = 20;

    public function createPaginator(
        QueryBuilder $queryBuilder,
        int $page = self::PAGINATOR_DEFAULT_PAGE,
        int $limit = self::PAGINATOR_DEFAULT_LIMIT,
        bool $fetchJoinCollection = false,
        bool $useOutputWalkers = false
    ): Pagerfanta;

    /** @param mixed[] $collection */
    public function createPaginatedResponse(iterable $collection, Pagerfanta $paginator): PaginatedCollection;

    /**
     * @param mixed[] $collection
     * @param mixed[] $metadata
     */
    public function createCustomPaginatedResponse(iterable $collection, array $metadata): PaginatedCollection;
}
