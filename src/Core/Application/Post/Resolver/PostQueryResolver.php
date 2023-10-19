<?php

declare(strict_types=1);

namespace App\Core\Application\Post\Resolver;

use App\Core\Application\Post\Query\FindPostQuery;
use App\Core\Application\Post\Query\GetPostsQuery;
use App\Core\Domain\Post\Factory\PostQueryFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final readonly class PostQueryResolver implements EventSubscriberInterface
{
    public function __construct(
        private PostQueryFactoryInterface $postQueryFactory
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
