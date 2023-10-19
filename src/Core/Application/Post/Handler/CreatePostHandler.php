<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Handler;

use App\Core\Application\Post\Command\CreatePostCommand;
use App\Core\Domain\Post\Factory\PostFactoryInterface;
use App\Core\Infrastructure\Repository\Post\PostRepositoryInterface;
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
