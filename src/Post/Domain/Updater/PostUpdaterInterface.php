<?php

declare(strict_types=1);

namespace App\Post\Domain\Updater;

use App\Post\Application\Command\UpdatePostCommandInterface;
use App\Post\Domain\Model\PostInterface;

interface PostUpdaterInterface
{
    public function update(PostInterface $post, UpdatePostCommandInterface $updatePostCommand): void;
}
