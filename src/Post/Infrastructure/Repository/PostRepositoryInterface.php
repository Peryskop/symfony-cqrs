<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Repository;

use App\Post\Domain\Model\Post;
use Doctrine\ORM\QueryBuilder;

interface PostRepositoryInterface
{
    public function save(Post $post): void;

    public function flush(): void;

    public function deleteByUuid(string $uuid): void;

    /** @param Post[] $params */
    public function findByParams(array $params): QueryBuilder;

    public function findPostByUuid(string $uuid): ?Post;
}
