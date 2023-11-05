<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Command;

use App\Shared\Command\CommandInterface;

final readonly class CreatePostCommand implements CommandInterface
{
    public function __construct(
        public ?string $uuid = null,
        public ?string $description = null
    ) {
    }
}