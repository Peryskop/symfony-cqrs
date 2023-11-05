<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Application\Command\DeletePostCommand;
use App\Post\Application\Command\UpdatePostCommand;
use Symfony\Component\HttpFoundation\Request;

interface PostCommandFactoryInterface
{
    public function createCreatePostCommandFromRequest(Request $request): CreatePostCommand;

    public function createUpdatePostCommandFromRequest(Request $request): UpdatePostCommand;

    public function createDeletePostCommandFromRequest(Request $request): DeletePostCommand;
}
