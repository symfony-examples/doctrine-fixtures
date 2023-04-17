<?php

declare(strict_types=1);

namespace App\DataFixtures\Test;

use App\Entity\SharedEntityParent;
use Doctrine\Persistence\ObjectManager;

final class SharedEntityParentFixtures extends AbstractTestFixtures
{
    public const SHARED_ENTITY_PARENT = 'shared';

    public function load(ObjectManager $manager): void
    {
        $entity = (new SharedEntityParent())
            ->setFirstname(firstname: 'shared parent firstname')
            ->setLastname(lastname: 'shared parent lastname')
        ;

        $manager->persist($entity);
        $manager->flush();

        $this->setReference(self::SHARED_ENTITY_PARENT, $entity);
    }
}
