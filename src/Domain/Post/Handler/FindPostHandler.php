<?php

declare(strict_types=1);

namespace App\Domain\Post\Handler;

use App\Domain\Post\Entity\Post;
use App\Domain\Post\Factory\ResponseFactory;
use App\Domain\Post\Query\FindPostQuery;
use App\Domain\Post\Repository\PostRepository;
use App\Shared\Response\AbstractApiResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final class FindPostHandler extends AbstractApiResponse
{
    public function __construct(
        readonly SerializerInterface $serializer,
        private readonly PostRepository $postRepository,
        private readonly ResponseFactory $responseFactory
    ) {
        parent::__construct($serializer);
    }

    public function __invoke(FindPostQuery $findPostQuery): Response
    {
        /** @var Post|null $post */
        $post = $this->postRepository->findOneBy([
            'uuid' => Uuid::fromString($findPostQuery->getUuid()),
        ]);

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
