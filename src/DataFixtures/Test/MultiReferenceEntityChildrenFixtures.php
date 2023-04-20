<?php

declare(strict_types=1);

namespace App\DataFixtures\Test;

use App\Entity\MultiReferenceEntityChildren;
use App\Entity\MultiReferenceEntityParent;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class MultiReferenceEntityChildrenFixtures extends AbstractTestFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $parentEntities = $manager->getRepository(MultiReferenceEntityParent::class)
            ->findAll();

        $entitiesProperties = [
            [
                'title' => 'First multi reference title',
                'owners' => [
                    $parentEntities[0],
                ],
            ],
            [
                'title' => 'Second multi reference title',
                'owners' => [
                    $parentEntities[0],
                    $parentEntities[1],
                ],
            ],
            [
                'title' => 'Third multi reference title',
                'owners' => [
                    $parentEntities[0],
                    $parentEntities[1],
                    $parentEntities[2],
                ],
            ],
        ];

        foreach ($entitiesProperties as $entityProperties) {
            $entity = (new MultiReferenceEntityChildren())
                ->setTitle($entityProperties['title'])
            ;

            foreach ($entityProperties['owners'] as $owner) {
                $entity->addOwner($owner);
            }

            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MultiReferenceEntityParentFixtures::class,
        ];
    }
}
