<?php

namespace App\Repository;

use App\Entity\SharedEntityChildren;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SharedEntityChildren>
 *
 * @method SharedEntityChildren|null find($id, $lockMode = null, $lockVersion = null)
 * @method SharedEntityChildren|null findOneBy(array $criteria, array $orderBy = null)
 * @method SharedEntityChildren[]    findAll()
 * @method SharedEntityChildren[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SharedEntityChildrenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SharedEntityChildren::class);
    }
}
