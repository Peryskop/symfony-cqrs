<?php

declare(strict_types=1);

namespace App\Post\Application\Query;

final readonly class GetPostsQuery implements GetPostsQueryInterface
{
    /** @param mixed[] $params */
    public function __construct(
        private array $params = [],
        private ?int $page = null,
        private ?int $limit = null
    ) {
    }

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
