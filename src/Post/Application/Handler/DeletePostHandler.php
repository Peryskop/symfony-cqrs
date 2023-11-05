<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Handler;

use App\Core\Application\Post\Command\DeletePostCommand;
use App\Core\Infrastructure\Repository\Post\PostRepositoryInterface;
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
