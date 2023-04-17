<?php

namespace App\Repository;

use App\Entity\SharedEntityParent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SharedEntityParent>
 *
 * @method SharedEntityParent|null find($id, $lockMode = null, $lockVersion = null)
 * @method SharedEntityParent|null findOneBy(array $criteria, array $orderBy = null)
 * @method SharedEntityParent[]    findAll()
 * @method SharedEntityParent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SharedEntityParentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SharedEntityParent::class);
    }
}
