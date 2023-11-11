<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Command\DeletePostCommandInterface;
use App\Shared\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class DeletePostAction
{
    public function __construct(
        private CommandBusInterface $bus,
        private DeletePostCommandInterface $deletePostCommand
    ) {
    }

    public function __invoke(): Response
    {
        $this->bus->dispatch($this->deletePostCommand);

        return new JsonResponse(
            [
                'message' => 'Post deleted',
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
