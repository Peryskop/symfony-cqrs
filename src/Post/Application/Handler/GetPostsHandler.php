<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Handler;

use App\Core\Application\Post\Query\GetPostsQuery;
use App\Core\Infrastructure\Repository\Post\PostRepositoryInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetPostsHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(GetPostsQuery $getPostsQuery): QueryBuilder
    {
        return $this->postRepository->findByParams($getPostsQuery->getParams());
    }
}
