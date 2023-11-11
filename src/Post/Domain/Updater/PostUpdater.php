<?php

declare(strict_types=1);

namespace App\Post\Domain\Updater;

use App\Post\Application\Command\UpdatePostCommandInterface;
use App\Post\Domain\Model\PostInterface;

final class PostUpdater implements PostUpdaterInterface
{
    public function update(PostInterface $post, UpdatePostCommandInterface $updatePostCommand): void
    {
        $post->setDescription($updatePostCommand->getDescription());
        $post->setUpdatedAt(new \DateTimeImmutable());
    }
}
