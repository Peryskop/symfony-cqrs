<?php

declare(strict_types=1);

namespace App\Core\Presentation\Rest\Post;

use App\Core\Application\Post\Command\DeletePostCommand;
use App\Core\Application\Post\Resolver\MapPostCommand;
use App\Shared\Command\MessengerCommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final readonly class DeletePostAction
{
    public function __construct(
        private MessengerCommandBus $bus
    ) {
    }

    public function __invoke(#[MapPostCommand] DeletePostCommand $deletePostCommand): Response
    {
        $this->bus->dispatch($deletePostCommand);

        return new JsonResponse(
            [
                'message' => 'Post deleted',
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
