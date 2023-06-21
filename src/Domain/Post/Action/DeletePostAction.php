<?php

declare(strict_types=1);

namespace App\Domain\Post\Action;

use App\Domain\Post\Command\DeletePostCommand;
use App\Domain\Post\Resolver\MapPostCommand;
use App\Shared\Command\MessengerCommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class DeletePostAction
{
    public function __construct(
        private readonly MessengerCommandBus $bus
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
