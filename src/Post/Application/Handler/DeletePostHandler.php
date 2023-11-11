<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Command\DeletePostCommandInterface;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;

final readonly class DeletePostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(DeletePostCommandInterface $deletePostCommand): void
    {
        $this->postRepository->deleteByUuid($deletePostCommand->getUuid());
    }
}
