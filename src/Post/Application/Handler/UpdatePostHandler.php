<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Command\UpdatePostCommandInterface;
use App\Post\Domain\Updater\PostUpdaterInterface;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;

final readonly class UpdatePostHandler
{
    public function __construct(
        private PostUpdaterInterface $postUpdater,
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(UpdatePostCommandInterface $updatePostCommand): void
    {
        $post = $this->postRepository->findPostByUuid($updatePostCommand->getUuid());

        $this->postUpdater->update($post, $updatePostCommand);

        $this->postRepository->save($post);
    }
}
