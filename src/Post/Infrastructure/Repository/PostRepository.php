<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository\Post;

use App\Core\Domain\Post\Model\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @method Post|null findOneBy(array $criteria, ?array $orderBy = null)
 */
final class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
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

    public function findByParams(array $params): QueryBuilder
    {
        return $this->createQueryBuilder('o')
        ;
    }

    public function findPostByUuid(string $uuid): ?Post
    {
        return $this->findOneBy([
            'uuid' => Uuid::fromString($uuid),
        ]);
    }
}
