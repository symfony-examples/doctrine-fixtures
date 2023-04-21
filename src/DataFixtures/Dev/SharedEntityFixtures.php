<?php

declare(strict_types=1);

namespace App\DataFixtures\Dev;

use App\Entity\SharedEntityChildren;
use App\Entity\SharedEntityParent;
use Doctrine\Persistence\ObjectManager;

final class SharedEntityFixtures extends AbstractDevFixtures
{
    public SharedEntityParent $parentEntity;

    public function load(ObjectManager $manager): void
    {
        $this->loadParents(manager: $manager);
        $this->loadChildren(manager: $manager);
    }

    public function loadChildren(ObjectManager $manager): void
    {
        $entitiesProperties = [
            [
                'title' => 'first shared children',
                'owner' => $this->parentEntity,
            ],
            [
                'title' => 'second shared children',
                'owner' => $this->parentEntity,
            ],
        ];

        foreach ($entitiesProperties as $entityProperty) {
            $entity = (new SharedEntityChildren())
                ->setTitle(title: $entityProperty['title'])
                ->setOwner(owner: $entityProperty['owner'])
            ;

            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function loadParents(ObjectManager $manager): void
    {
        $entity = (new SharedEntityParent())
            ->setFirstname(firstname: 'shared parent firstname')
            ->setLastname(lastname: 'shared parent lastname')
        ;

        $manager->persist($entity);
        $this->parentEntity = $entity;

        $manager->flush();
    }
}
