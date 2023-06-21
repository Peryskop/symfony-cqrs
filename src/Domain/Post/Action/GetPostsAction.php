<?php

declare(strict_types=1);

namespace App\Domain\Post\Action;

use App\Domain\Post\Query\GetPostsQuery;
use App\Domain\Post\Resolver\MapPostQuery;
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
        private readonly MessengerQueryBus $bus
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(#[MapPostQuery] GetPostsQuery $getPostsQuery): Response
    {
        return $this->bus->handle($getPostsQuery);
    }
}
