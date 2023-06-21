<?php

declare(strict_types=1);

namespace App\Domain\Post\Resolver;

use App\Domain\Post\Factory\PostQueryFactory;
use App\Domain\Post\Query\FindPostQuery;
use App\Domain\Post\Query\GetPostsQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class PostQueryResolver implements EventSubscriberInterface
{
    public function __construct(
        private readonly PostQueryFactory $postQueryFactory
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => 'onKernelControllerArguments',
        ];
    }

    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $arguments = $event->getArguments();
        $request = $event->getRequest();

        foreach ($arguments as $i => $argument) {
            $payload = match (true) {
                $argument instanceof GetPostsQuery => $this->postQueryFactory->createGetPostsQueryFromRequest($request),
                $argument instanceof FindPostQuery => $this->postQueryFactory->createFindPostQueryFromRequest($request),
                default => null
            };

            if (! $payload) {
                continue;
            }

            $arguments[$i] = $payload;

            $event->setArguments($arguments);
        }
    }
}
