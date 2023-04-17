<?php

declare(strict_types=1);

namespace App\DataFixtures\Test;

use App\Entity\SharedEntityChildren;
use App\Entity\SharedEntityParent;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class SharedEntityChildrenFixtures extends AbstractTestFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $sharedParentEntity = $this->getReference(SharedEntityParentFixtures::SHARED_ENTITY_PARENT);

        if (!$sharedParentEntity instanceof SharedEntityParent) {
            throw new \LogicException(message: sprintf('Parent shared entity has to be an instance of %s', SharedEntityParent::class));
        }

        $entitiesProperties = [
            [
                'title' => 'first shared children',
                'owner' => $sharedParentEntity,
            ],
            [
                'title' => 'second shared children',
                'owner' => $sharedParentEntity,
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

    public function getDependencies()
    {
        return [
            SharedEntityParentFixtures::class,
        ];
    }
}
