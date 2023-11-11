<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

final readonly class DeletePostCommand implements DeletePostCommandInterface
{
    public function __construct(
        private ?string $uuid = null
    ) {
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }
}
