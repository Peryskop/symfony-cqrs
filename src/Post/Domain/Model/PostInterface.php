<?php

declare(strict_types=1);

namespace App\Post\Domain\Model;

interface PostInterface
{
    public function getId(): ?int;

    public function getUuid(): string;

    public function getDescription(): string;

    public function setDescription(string $description): void;

    public function getCreatedAt(): \DateTimeImmutable;

    public function getUpdatedAt(): \DateTimeImmutable;

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void;
}
