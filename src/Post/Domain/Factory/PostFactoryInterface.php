<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Domain\Model\Post;

interface PostFactoryInterface
{
    public function createFromCommand(CreatePostCommand $createPostCommand): Post;
}
