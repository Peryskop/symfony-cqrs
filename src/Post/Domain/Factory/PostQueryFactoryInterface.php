<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Query\FindPostQueryInterface;
use App\Post\Application\Query\GetPostsQueryInterface;

interface PostQueryFactoryInterface
{
    public function createGetPostsQuery(): GetPostsQueryInterface;

    public function createFindPostQuery(): FindPostQueryInterface;
}
