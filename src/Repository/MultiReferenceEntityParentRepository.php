<?php

namespace App\Repository;

use App\Entity\MultiReferenceEntityParent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MultiReferenceEntityParent>
 *
 * @method MultiReferenceEntityParent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MultiReferenceEntityParent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MultiReferenceEntityParent[]    findAll()
 * @method MultiReferenceEntityParent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultiReferenceEntityParentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiReferenceEntityParent::class);
    }
}
