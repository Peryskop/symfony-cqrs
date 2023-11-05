<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Domain\Model\Post;
use Symfony\Component\Uid\Uuid;

final class PostFactory implements PostFactoryInterface
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
