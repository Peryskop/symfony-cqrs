<?php

declare(strict_types=1);

namespace App\Domain\Post\Action;

use App\Domain\Post\Command\CreatePostCommand;
use App\Domain\Post\Resolver\MapPostCommand;
use App\Shared\Command\MessengerCommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class CreatePostAction
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
