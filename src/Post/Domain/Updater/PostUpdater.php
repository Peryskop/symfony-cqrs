<?php

declare(strict_types=1);

namespace App\Post\Domain\Updater;

use App\Post\Application\Command\UpdatePostCommand;
use App\Post\Domain\Model\Post;

final class PostUpdater implements PostUpdaterInterface
{
    public function update(Post $post, UpdatePostCommand $updatePostCommand): void
    {
        $post->setDescription($updatePostCommand->description);
        $post->setUpdatedAt(new \DateTimeImmutable());
    }
}
