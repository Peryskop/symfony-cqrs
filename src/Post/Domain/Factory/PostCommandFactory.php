<?php

declare(strict_types=1);

namespace App\Post\Domain\Factory;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Application\Command\CreatePostCommandInterface;
use App\Post\Application\Command\DeletePostCommand;
use App\Post\Application\Command\DeletePostCommandInterface;
use App\Post\Application\Command\UpdatePostCommand;
use App\Post\Application\Command\UpdatePostCommandInterface;
use App\Shared\DataCollector\DataExtractorInterface;
use Symfony\Component\Uid\Uuid;

final readonly class PostCommandFactory implements PostCommandFactoryInterface
{
    /** @var mixed[] $data */
    private array $data;

    public function __construct(
        private DataExtractorInterface $dataCollector
    ) {
        $this->data = $this->dataCollector->collect();
    }

    public function createCreatePostCommand(): CreatePostCommandInterface
    {
        return new CreatePostCommand(
            uuid: Uuid::v4()->jsonSerialize(),
            description: $this->data['description'] ?? null
        );
    }

    public function createUpdatePostCommand(): UpdatePostCommandInterface
    {
        return new UpdatePostCommand(
            uuid: $this->data['uuid'],
            description: $this->data['description'] ?? null
        );
    }

    public function createDeletePostCommand(): DeletePostCommandInterface
    {
        return new DeletePostCommand(
            uuid: $this->data['uuid']
        );
    }
}
