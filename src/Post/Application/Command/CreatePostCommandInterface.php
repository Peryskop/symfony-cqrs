<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use App\Shared\Command\CommandInterface;

interface CreatePostCommandInterface extends CommandInterface
{
    public function getUuid(): ?string;

    public function getDescription(): ?string;
}
