<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Command\UpdatePostCommand;
use App\Post\Domain\Updater\PostUpdaterInterface;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class UpdatePostHandler
{
    public function __construct(
        private PostUpdaterInterface $postUpdater,
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(UpdatePostCommand $updatePostCommand): void
    {
        $post = $this->postRepository->findPostByUuid($updatePostCommand->uuid);

        $this->postUpdater->update($post, $updatePostCommand);

        $this->postRepository->save($post);
    }
}
