<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Command\DeletePostCommand;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class DeletePostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(DeletePostCommand $deletePostCommand): void
    {
        $this->postRepository->deleteByUuid(Uuid::fromString($deletePostCommand->uuid));
    }
}
