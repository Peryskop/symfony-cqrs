<?php

declare(strict_types=1);

namespace App\Domain\Post\Command;

use App\Shared\Command\CommandInterface;

final readonly class DeletePostCommand implements CommandInterface
{
    public function __construct(
        public ?string $uuid = null
    ) {
    }
}
