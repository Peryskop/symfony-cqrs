<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

final readonly class CreatePostCommand implements CreatePostCommandInterface
{
    public function __construct(
        private ?string $uuid = null,
        private ?string $description = null
    ) {
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
