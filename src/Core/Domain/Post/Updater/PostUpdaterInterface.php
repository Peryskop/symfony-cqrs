<?php

declare(strict_types=1);

namespace App\Core\Domain\Post\Updater;

use App\Core\Application\Post\Command\UpdatePostCommand;
use App\Core\Domain\Post\Model\Post;

interface PostUpdaterInterface
{
    public function update(Post $post, UpdatePostCommand $updatePostCommand): void;
}
