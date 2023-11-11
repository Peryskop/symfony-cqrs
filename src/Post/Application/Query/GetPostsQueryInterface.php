<?php

declare(strict_types=1);

namespace App\Post\Application\Query;

use App\Shared\Query\QueryInterface;

interface GetPostsQueryInterface extends QueryInterface
{
    /** @return mixed[] */
    public function getParams(): array;

    public function getPage(): ?int;

    public function getLimit(): ?int;
}
