<?php

declare(strict_types=1);

namespace App\Domain\Post\Resolver;

use App\Domain\Post\Command\CreatePostCommand;
use App\Domain\Post\Command\DeletePostCommand;
use App\Domain\Post\Command\UpdatePostCommand;
use App\Domain\Post\Factory\PostCommandFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class PostCommandResolver implements EventSubscriberInterface
{
    public function __construct(
        private readonly PostCommandFactory $postCommandFactory
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
                $argument instanceof CreatePostCommand => $this->postCommandFactory->createCreatePostCommandFromRequest($request),
                $argument instanceof UpdatePostCommand => $this->postCommandFactory->createUpdatePostCommandFromRequest($request),
                $argument instanceof DeletePostCommand => $this->postCommandFactory->createDeletePostCommandFromRequest($request),
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
