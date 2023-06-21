<?php

declare(strict_types=1);

namespace App\Domain\Post\Handler;

use App\Domain\Post\Command\UpdatePostCommand;
use App\Domain\Post\Entity\Post;
use App\Domain\Post\Repository\PostRepository;
use App\Domain\Post\Updater\PostUpdater;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class UpdatePostHandler
{
    public function __construct(
        private PostUpdater $postUpdater,
        private PostRepository $postRepository
    ) {
    }

    public function __invoke(UpdatePostCommand $updatePostCommand): void
    {
        /** @var Post $post */
        $post = $this->postRepository->findOneBy([
            'uuid' => Uuid::fromString($updatePostCommand->uuid),
        ]);

        $this->postUpdater->update($post, $updatePostCommand);

        $this->postRepository->save($post);
    }
}
