<?php

declare(strict_types=1);

namespace App\Shared\Paginator;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Response;

final class Paginator implements PaginatorInterface
{
    public function createPaginator(
        QueryBuilder $queryBuilder,
        int $page = self::PAGINATOR_DEFAULT_PAGE,
        int $limit = self::PAGINATOR_DEFAULT_LIMIT,
        bool $fetchJoinCollection = false,
        bool $useOutputWalkers = false
    ): Pagerfanta {
        $paginator = new Pagerfanta(new QueryAdapter($queryBuilder, false, false));

        $paginator->setMaxPerPage($limit);

        if ($page > $paginator->getNbPages()) {
            throw new \Exception('Page not found', Response::HTTP_NOT_FOUND);
        }

        $paginator->setCurrentPage($page);

        return $paginator;
    }

    public function createPaginatedResponse(iterable $collection, Pagerfanta $paginator): PaginatedCollection
    {
        return new PaginatedCollection(
            $collection,
            $paginator->getNbResults(),
            $paginator->getCurrentPage(),
            $paginator->getNbPages()
        );
    }

    public function createCustomPaginatedResponse(iterable $collection, array $metadata): PaginatedCollection
    {
        return new PaginatedCollection(
            $collection,
            $metadata['nbResults'],
            $metadata['currentPage'],
            $metadata['nbPages']
        );
    }
}
