<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Domain\Post\Model\Post;
use App\Core\Infrastructure\Response\Post\FindPostResponse;

final class ResponseFactory implements ResponseFactoryInterface
{
    public function createFromPost(Post $post): FindPostResponse
    {
        return new FindPostResponse(
            uuid: $post->getUuid(),
            description: $post->getDescription()
        );
    }

    public function createFromPosts(iterable $posts): array
    {
        $response = [];

        foreach ($posts as $post) {
            $response[] = $this->createFromPost($post);
        }

        return $response;
    }
}
