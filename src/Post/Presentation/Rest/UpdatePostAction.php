<?php

declare(strict_types=1);

namespace App\Core\Presentation\Rest\Post;

use App\Core\Application\Post\Command\UpdatePostCommand;
use App\Core\Application\Post\Resolver\MapPostCommand;
use App\Shared\Command\MessengerCommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final readonly class UpdatePostAction
{
    public function __construct(
        private MessengerCommandBus $bus
    ) {
    }

    public function __invoke(#[MapPostCommand] UpdatePostCommand $updatePostCommand): Response
    {
        $this->bus->dispatch($updatePostCommand);

        return new JsonResponse(
            [
                'message' => 'Post updated',
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
