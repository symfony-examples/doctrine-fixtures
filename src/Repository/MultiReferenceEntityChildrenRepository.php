<?php

namespace App\Repository;

use App\Entity\MultiReferenceEntityChildren;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MultiReferenceEntityChildren>
 *
 * @method MultiReferenceEntityChildren|null find($id, $lockMode = null, $lockVersion = null)
 * @method MultiReferenceEntityChildren|null findOneBy(array $criteria, array $orderBy = null)
 * @method MultiReferenceEntityChildren[]    findAll()
 * @method MultiReferenceEntityChildren[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultiReferenceEntityChildrenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiReferenceEntityChildren::class);
    }
}
