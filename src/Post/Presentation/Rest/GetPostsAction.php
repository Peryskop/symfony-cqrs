<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Query\GetPostsQuery;
use App\Post\Application\Resolver\MapPostQuery;
use App\Post\Domain\Factory\ResponseFactory;
use App\Shared\Paginator\PaginatorInterface;
use App\Shared\Query\MessengerQueryBus;
use App\Shared\Response\AbstractApiResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class GetPostsAction extends AbstractApiResponse
{
    public function __construct(
        readonly SerializerInterface $serializer,
        private readonly MessengerQueryBus $bus,
        private readonly PaginatorInterface $paginator,
        private readonly ResponseFactory $responseFactory
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(#[MapPostQuery] GetPostsQuery $getPostsQuery): Response
    {
        $postsQueryBuilder = $this->bus->handle($getPostsQuery);

        $paginator = $this->paginator->createPaginator(
            $postsQueryBuilder,
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
