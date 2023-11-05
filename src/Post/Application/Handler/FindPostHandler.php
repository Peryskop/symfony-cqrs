<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Query\FindPostQuery;
use App\Post\Domain\Model\Post;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class FindPostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(FindPostQuery $findPostQuery): ?Post
    {
        return $this->postRepository->findPostByUuid($findPostQuery->getUuid());
    }
}
