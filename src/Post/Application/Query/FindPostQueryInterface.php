<?php

declare(strict_types=1);

namespace App\Post\Application\Query;

use App\Shared\Query\QueryInterface;

interface FindPostQueryInterface extends QueryInterface
{
    public function getUuid(): string;
}
