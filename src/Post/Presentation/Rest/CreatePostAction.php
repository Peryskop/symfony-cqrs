<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Command\CreatePostCommandInterface;
use App\Shared\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class CreatePostAction
{
    public function __construct(
        private CommandBusInterface $bus,
        private CreatePostCommandInterface $createPostCommand
    ) {
    }

    public function __invoke(): Response
    {
        $this->bus->dispatch($this->createPostCommand);

        return new JsonResponse(
            [
                "postId" => $this->createPostCommand->getUuid(),
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
