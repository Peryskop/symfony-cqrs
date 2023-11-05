<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Domain\Model\Post;
use App\Post\Infrastructure\Response\FindPostResponse;

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
