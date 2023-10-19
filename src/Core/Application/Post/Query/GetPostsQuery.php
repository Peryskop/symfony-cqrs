<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Query;

use App\Shared\Query\QueryInterface;

final readonly class GetPostsQuery implements QueryInterface
{
    /** @param mixed[] $params */
    public function __construct(
        private array $params = [],
        private ?int $page = null,
        private ?int $limit = null
    ) {
    }

    /** @return mixed[] */
    public function getParams(): array
    {
        return $this->params;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }
}
