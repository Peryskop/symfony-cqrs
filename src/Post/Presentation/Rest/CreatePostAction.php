<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Application\Resolver\MapPostCommand;
use App\Shared\Command\MessengerCommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final readonly class CreatePostAction
{
    public function __construct(
        private MessengerCommandBus $bus
    ) {
    }

    public function __invoke(#[MapPostCommand] CreatePostCommand $createPostCommand): Response
    {
        $this->bus->dispatch($createPostCommand);

        return new JsonResponse(
            [
                "postId" => $createPostCommand->uuid,
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
