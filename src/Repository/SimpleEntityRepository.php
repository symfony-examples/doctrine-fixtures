<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SimpleEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SimpleEntity>
 *
 * @method SimpleEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SimpleEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SimpleEntity[]    findAll()
 * @method SimpleEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SimpleEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SimpleEntity::class);
    }
}
