<?php

declare(strict_types=1);

namespace App\Domain\Post\Handler;

use App\Domain\Post\Factory\ResponseFactory;
use App\Domain\Post\Query\GetPostsQuery;
use App\Domain\Post\Repository\PostRepository;
use App\Shared\Paginator\Paginator;
use App\Shared\Response\AbstractApiResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetPostsHandler extends AbstractApiResponse
{
    public function __construct(
        readonly SerializerInterface $serializer,
        private readonly PostRepository $postRepository,
        private readonly Paginator $paginator,
        private readonly ResponseFactory $responseFactory
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(GetPostsQuery $getPostsQuery): Response
    {
        $queryBuilder = $this->postRepository->findByParams($getPostsQuery->getParams());

        $paginator = $this->paginator->createPaginator(
            $queryBuilder,
            $getPostsQuery->getPage(),
            $getPostsQuery->getLimit()
        );

        $dtos = $this->responseFactory->createFromPosts($paginator);
        $paginatedResponse = $this->paginator->createPaginatedResponse($dtos, $paginator);

        return $this->respond(
            $paginatedResponse,
            ['post:read']
        );
    }
}
