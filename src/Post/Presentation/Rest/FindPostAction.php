<?php

declare(strict_types=1);

namespace App\Core\Presentation\Rest\Post;

use App\Core\Application\Post\Query\FindPostQuery;
use App\Core\Application\Post\Resolver\MapPostQuery;
use App\Core\Domain\Post\Factory\ResponseFactory;
use App\Shared\Query\MessengerQueryBus;
use App\Shared\Response\AbstractApiResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class FindPostAction extends AbstractApiResponse
{
    public function __construct(
        readonly SerializerInterface $serializer,
        private readonly MessengerQueryBus $bus,
        private readonly ResponseFactory $responseFactory
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(#[MapPostQuery] FindPostQuery $findPostQuery): Response
    {
        $post = $this->bus->handle($findPostQuery);

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
