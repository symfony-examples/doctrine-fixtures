<?php

declare(strict_types=1);

namespace App\DataFixtures\Test;

use App\Entity\SimpleEntity;
use Doctrine\Persistence\ObjectManager;

final class SimpleEntityFixtures extends AbstractTestFixtures
{
    public function load(ObjectManager $manager): void
    {
        $entity = (new SimpleEntity())
            ->setTitle(title: 'Simple entity title for test purpose')
            ->setCreated(created: new \DateTime())
        ;

        $manager->persist($entity);
        $manager->flush();
    }
}
