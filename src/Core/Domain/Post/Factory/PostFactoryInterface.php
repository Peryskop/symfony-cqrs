<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Factory;

use App\Core\Application\Post\Command\CreatePostCommand;
use App\Core\Domain\Post\Model\Post;

interface PostFactoryInterface
{
    public function createFromCommand(CreatePostCommand $createPostCommand): Post;
}
