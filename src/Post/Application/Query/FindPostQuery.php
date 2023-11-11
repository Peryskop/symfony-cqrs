<?php

declare(strict_types=1);

namespace App\Post\Application\Query;

final readonly class FindPostQuery implements FindPostQueryInterface
{
    public function __construct(
        private ?string $uuid = null
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
