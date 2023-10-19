<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Domain\Post\Model\Post;
use App\Core\Infrastructure\Response\Post\FindPostResponse;

interface ResponseFactoryInterface
{
    public function createFromPost(Post $post): FindPostResponse;

    /**
     * @param Post[] $posts
     *
     * @return FindPostResponse[]
     */
    public function createFromPosts(iterable $posts): array;
}
