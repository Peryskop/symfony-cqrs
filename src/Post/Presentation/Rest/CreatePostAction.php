<?php

declare(strict_types=1);

namespace App\Core\Presentation\Rest\Post;

use App\Core\Application\Post\Command\CreatePostCommand;
use App\Core\Application\Post\Resolver\MapPostCommand;
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
