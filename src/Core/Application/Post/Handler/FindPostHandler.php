<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Handler;

use App\Core\Application\Post\Query\FindPostQuery;
use App\Core\Domain\Post\Model\Post;
use App\Core\Infrastructure\Repository\Post\PostRepositoryInterface;
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
