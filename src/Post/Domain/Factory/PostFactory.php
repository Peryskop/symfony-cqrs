<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Command\CreatePostCommandInterface;
use App\Post\Domain\Model\Post;
use Symfony\Component\Uid\Uuid;

final class PostFactory implements PostFactoryInterface
{
    public function createFromCommand(CreatePostCommandInterface $createPostCommand): Post
    {
        return new Post(
            id: null,
            uuid: Uuid::fromString($createPostCommand->getUuid()),
            description: $createPostCommand->getDescription(),
            createdAt: new \DateTimeImmutable(),
            updatedAt: new \DateTimeImmutable()
        );
    }
}
