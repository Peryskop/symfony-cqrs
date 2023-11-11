<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Query\GetPostsQueryInterface;
use App\Post\Domain\Factory\ResponseFactoryInterface;
use App\Shared\Paginator\PaginatorInterface;
use App\Shared\Query\QueryBusInterface;
use App\Shared\Response\AbstractApiResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

final class GetPostsAction extends AbstractApiResponse
{
    public function __construct(
        readonly SerializerInterface $serializer,
        private readonly QueryBusInterface $bus,
        private readonly PaginatorInterface $paginator,
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly GetPostsQueryInterface $getPostsQuery
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(): Response
    {
        $postsQueryBuilder = $this->bus->handle($this->getPostsQuery);

        $paginator = $this->paginator->createPaginator(
            $postsQueryBuilder,
            $this->getPostsQuery->getPage(),
            $this->getPostsQuery->getLimit()
        );

        $dtos = $this->responseFactory->createFromPosts($paginator);
        $paginatedResponse = $this->paginator->createPaginatedResponse($dtos, $paginator);

        return $this->respond(
            $paginatedResponse,
            ['post:read']
        );
    }
}
