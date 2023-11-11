<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use App\Shared\Command\CommandInterface;

interface DeletePostCommandInterface extends CommandInterface
{
    public function getUuid(): ?string;
}
