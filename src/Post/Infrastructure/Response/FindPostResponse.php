<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Response;

use JMS\Serializer\Annotation as Serialization;

final readonly class FindPostResponse
{
    public function __construct(
        #[Serialization\Groups(['post:read'])]
        public string $uuid,
        #[Serialization\Groups(['post:read'])]
        public string $description
    ) {
    }
}
