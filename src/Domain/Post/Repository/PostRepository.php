<?php

declare(strict_types=1);

namespace App\Domain\Post\Repository;

use App\Domain\Post\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

final class PostRepository extends ServiceEntityRepository
{
    public function __construct(
        readonly ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $post): void
    {
        $this->_em->persist($post);
        $this->flush();
    }

    public function flush(): void
    {
        $this->_em->flush();
    }

    public function deleteByUuid(Uuid $uuid): void
    {
        $post = $this->findOneBy([
            'uuid' => $uuid,
        ]);
        $this->_em->remove($post);
        $this->flush();
    }

    /** @param mixed[] $params */
    public function findByParams(array $params): QueryBuilder
    {
        return $this->createQueryBuilder('o')
        ;
    }
}
