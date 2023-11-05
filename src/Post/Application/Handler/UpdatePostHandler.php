<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Handler;

use App\Core\Application\Post\Command\UpdatePostCommand;
use App\Core\Domain\Post\Updater\PostUpdaterInterface;
use App\Core\Infrastructure\Repository\Post\PostRepositoryInterface;
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
