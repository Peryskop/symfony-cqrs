<?php

declare(strict_types=1);

namespace App\Domain\Post\Factory;

use App\Domain\Post\Command\CreatePostCommand;
use App\Domain\Post\Entity\Post;
use Symfony\Component\Uid\Uuid;

final class PostFactory
{
    public function createFromCommand(CreatePostCommand $createPostCommand): Post
    {
        return new Post(
            id: null,
            uuid: Uuid::fromString($createPostCommand->uuid),
            description: $createPostCommand->description,
            createdAt: new \DateTimeImmutable(),
            updatedAt: new \DateTimeImmutable()
        );
    }
}
