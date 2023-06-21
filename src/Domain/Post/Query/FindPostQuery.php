<?php

declare(strict_types=1);

namespace App\Domain\Post\Query;

use App\Shared\Query\QueryInterface;

final readonly class FindPostQuery implements QueryInterface
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
