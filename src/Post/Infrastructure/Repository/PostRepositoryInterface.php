<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository\Post;

use App\Core\Domain\Post\Model\Post;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Uid\Uuid;

interface PostRepositoryInterface
{
    public function save(Post $post): void;

    public function flush(): void;

    public function deleteByUuid(Uuid $uuid): void;

    /** @param Post[] $params */
    public function findByParams(array $params): QueryBuilder;

    public function findPostByUuid(string $uuid): ?Post;
}