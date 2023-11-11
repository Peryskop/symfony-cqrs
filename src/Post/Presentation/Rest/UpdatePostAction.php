<?php

declare(strict_types=1);

namespace App\Post\Presentation\Rest;

use App\Post\Application\Command\UpdatePostCommandInterface;
use App\Shared\Command\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class UpdatePostAction
{
    public function __construct(
        private CommandBusInterface $bus,
        private UpdatePostCommandInterface $updatePostCommand
    ) {
    }

    public function __invoke(): Response
    {
        $this->bus->dispatch($this->updatePostCommand);

        return new JsonResponse(
            [
                'message' => 'Post updated',
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
