<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Query\GetPostsQuery;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
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
