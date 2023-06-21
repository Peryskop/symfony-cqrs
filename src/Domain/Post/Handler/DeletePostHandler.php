<?php

declare(strict_types=1);

namespace App\Domain\Post\Handler;

use App\Domain\Post\Command\DeletePostCommand;
use App\Domain\Post\Repository\PostRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class DeletePostHandler
{
    public function __construct(
        private PostRepository $postRepository
    ) {
    }

    public function __invoke(DeletePostCommand $deletePostCommand): void
    {
        $this->postRepository->deleteByUuid(Uuid::fromString($deletePostCommand->uuid));
    }
}
