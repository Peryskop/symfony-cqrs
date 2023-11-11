<?php

declare(strict_types=1);

namespace App\Post\Application\Handler;

use App\Post\Application\Query\GetPostsQueryInterface;
use App\Post\Infrastructure\Repository\PostRepositoryInterface;
use Doctrine\ORM\QueryBuilder;

final readonly class GetPostsHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function __invoke(GetPostsQueryInterface $getPostsQuery): QueryBuilder
    {
        return $this->postRepository->findByParams($getPostsQuery->getParams());
    }
}
