<?php

declare(strict_types=1);

namespace App\Shared\Response;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiResponse
{
    private const DEFAULT_SERIALIZATION_GROUP = 'Default';

    protected function __construct(
        private readonly SerializerInterface $serializer
    ) {
    }

    /** @param string[] $groups */
    protected function respond(
        mixed $data,
        array $groups = [],
        int $statusCode = Response::HTTP_OK,
    ): Response {
        $groups[] = self::DEFAULT_SERIALIZATION_GROUP;
        $context = SerializationContext::create()->setGroups($groups)->enableMaxDepthChecks();
        $serializedData = $this->serializer->serialize($data, 'json', $context);

        return new Response($serializedData, $statusCode, [
            'Content-type' => 'application/json',
        ]);
    }
}
