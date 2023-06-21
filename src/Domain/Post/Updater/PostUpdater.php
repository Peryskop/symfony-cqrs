<?php

declare(strict_types=1);

namespace App\Domain\Post\Updater;

use App\Domain\Post\Command\UpdatePostCommand;
use App\Domain\Post\Entity\Post;

final class PostUpdater
{
    public function update(Post $post, UpdatePostCommand $updatePostCommand): void
    {
        $post->setDescription($updatePostCommand->description);
        $post->setUpdatedAt(new \DateTimeImmutable());
    }
}
