<?php

declare(strict_types=1);

namespace App\Shared\DataCollector;

interface DataExtractorInterface
{
    /** @return mixed[] */
    public function collect(): array;
}
