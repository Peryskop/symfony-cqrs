<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Application\Post\Command\CreatePostCommand;
use App\Core\Domain\Post\Model\Post;
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
