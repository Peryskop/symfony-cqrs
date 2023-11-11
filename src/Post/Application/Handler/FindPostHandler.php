<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Query\FindPostQueryInterface;
use App\Post\Domain\Model\Post;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;

final readonly class FindPostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(FindPostQueryInterface $findPostQuery): ?Post
    {
        return $this->postRepository->findPostByUuid($findPostQuery->getUuid());
    }
}
