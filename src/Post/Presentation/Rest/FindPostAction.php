<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Query\FindPostQueryInterface;
use App\Post\Domain\Factory\ResponseFactoryInterface;
use App\Shared\Query\QueryBusInterface;
use App\Shared\Response\AbstractApiResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

final class FindPostAction extends AbstractApiResponse
{
    public function __construct(
        readonly SerializerInterface $serializer,
        private readonly QueryBusInterface $bus,
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly FindPostQueryInterface $findPostQuery
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(): Response
    {
        $post = $this->bus->handle($this->findPostQuery);

        if (! $post) {
            throw new \Exception('Not found.', Response::HTTP_NOT_FOUND);
        }

        $response = $this->responseFactory->createFromPost($post);

        return $this->respond(
            $response,
            ['post:read'],
        );
    }
}
