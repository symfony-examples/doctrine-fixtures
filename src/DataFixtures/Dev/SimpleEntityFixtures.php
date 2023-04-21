<?php

declare(strict_types=1);

namespace App\DataFixtures\Dev;

use App\Entity\SimpleEntity;
use Doctrine\Persistence\ObjectManager;

final class SimpleEntityFixtures extends AbstractDevFixtures
{
    public function load(ObjectManager $manager): void
    {
        $entity = (new SimpleEntity())
            ->setTitle('Simple entity title')
            ->setCreated(new \DateTime())
        ;

        $manager->persist($entity);
        $manager->flush();
    }
}
