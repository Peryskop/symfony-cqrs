<?php

declare(strict_types=1);

namespace App\Post\Domain\Updater;

use App\Post\Application\Command\UpdatePostCommand;
use App\Post\Domain\Model\Post;

interface PostUpdaterInterface
{
    public function update(Post $post, UpdatePostCommand $updatePostCommand): void;
}
