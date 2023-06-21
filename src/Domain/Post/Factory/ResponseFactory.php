<?php

declare(strict_types=1);

namespace App\Domain\Post\Factory;

use App\Domain\Post\Entity\Post;
use App\Domain\Post\Response\FindPostResponse;

final class ResponseFactory
{
    public function createFromPost(Post $post): FindPostResponse
    {
        return new FindPostResponse(
            uuid: $post->getUuid(),
            description: $post->getDescription()
        );
    }

    /**
     * @param Post[] $posts
     *
     * @return FindPostResponse[]
     */
    public function createFromPosts(iterable $posts): array
    {
        $response = [];

        foreach ($posts as $post) {
            $response[] = $this->createFromPost($post);
        }

        return $response;
    }
}
