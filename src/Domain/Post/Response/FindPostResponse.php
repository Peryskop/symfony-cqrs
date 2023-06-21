<?php

declare(strict_types=1);

namespace App\Domain\Post\Response;

use JMS\Serializer\Annotation as Serialization;

final class FindPostResponse
{
    public function __construct(
        #[Serialization\Groups(['post:read'])]
        public readonly string $uuid,
        #[Serialization\Groups(['post:read'])]
        public readonly string $description
    ) {
    }
}
