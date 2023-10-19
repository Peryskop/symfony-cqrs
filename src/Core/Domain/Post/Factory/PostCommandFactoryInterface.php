<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Application\Post\Command\CreatePostCommand;
use App\Core\Application\Post\Command\DeletePostCommand;
use App\Core\Application\Post\Command\UpdatePostCommand;
use Symfony\Component\HttpFoundation\Request;

interface PostCommandFactoryInterface
{
    public function createCreatePostCommandFromRequest(Request $request): CreatePostCommand;

    public function createUpdatePostCommandFromRequest(Request $request): UpdatePostCommand;

    public function createDeletePostCommandFromRequest(Request $request): DeletePostCommand;
}
