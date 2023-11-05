<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Application\Post\Command\CreatePostCommand;
use App\Core\Application\Post\Command\DeletePostCommand;
use App\Core\Application\Post\Command\UpdatePostCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\Uuid;

final class PostCommandFactory implements PostCommandFactoryInterface
{
    public function createCreatePostCommandFromRequest(Request $request): CreatePostCommand
    {
        $data = $request->toArray();
        return new CreatePostCommand(
            uuid: Uuid::v4()->jsonSerialize(),
            description: $data['description'] ?? null
        );
    }

    public function createUpdatePostCommandFromRequest(Request $request): UpdatePostCommand
    {
        $data = $request->toArray();
        return new UpdatePostCommand(
            uuid: $request->get('uuid'),
            description: $data['description'] ?? null
        );
    }

    public function createDeletePostCommandFromRequest(Request $request): DeletePostCommand
    {
        return new DeletePostCommand(
            uuid: $request->get('uuid')
        );
    }
}
