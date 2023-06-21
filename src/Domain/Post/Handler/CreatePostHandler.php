<?php

declare(strict_types=1);

namespace App\Domain\Post\Handler;

use App\Domain\Post\Command\CreatePostCommand;
use App\Domain\Post\Factory\PostFactory;
use App\Domain\Post\Repository\PostRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreatePostHandler
{
    public function __construct(
        private PostFactory $postFactory,
        private PostRepository $postRepository
    ) {
    }

    public function __invoke(CreatePostCommand $createPostCommand): void
    {
        $post = $this->postFactory->createFromCommand($createPostCommand);

        $this->postRepository->save($post);
    }
}
