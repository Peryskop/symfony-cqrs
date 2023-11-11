<?php

declare(strict_types=1);

namespace App\Shared\DataCollector;

use Symfony\Component\HttpFoundation\RequestStack;

final readonly class RequestDataExtractor implements DataExtractorInterface
{
    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function collect(): array
    {
        $request = $this->requestStack->getCurrentRequest();
        $data['params'] = $request->query->all();

        foreach ($request->attributes->get('_route_params') as $key => $value) {
            $data[$key] = $value;
        }

        foreach ($request->getPayload() as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}
