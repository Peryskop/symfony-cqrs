<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Domain\Factory\PostFactoryInterface;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreatePostHandler
{
    public function __construct(
        private PostFactoryInterface $postFactory,
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(CreatePostCommand $createPostCommand): void
    {
        $post = $this->postFactory->createFromCommand($createPostCommand);

        $this->postRepository->save($post);
    }
}
