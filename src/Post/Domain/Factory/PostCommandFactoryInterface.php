<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Command\CreatePostCommandInterface;
use App\Post\Application\Command\DeletePostCommandInterface;
use App\Post\Application\Command\UpdatePostCommandInterface;

interface PostCommandFactoryInterface
{
    public function createCreatePostCommand(): CreatePostCommandInterface;

    public function createUpdatePostCommand(): UpdatePostCommandInterface;

    public function createDeletePostCommand(): DeletePostCommandInterface;
}
