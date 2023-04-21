<?php

declare(strict_types=1);

namespace App\DataFixtures\Dev;

use App\Entity\MultiReferenceEntityChildren;
use App\Entity\MultiReferenceEntityParent;
use Doctrine\Persistence\ObjectManager;

final class MultiReferenceEntityFixtures extends AbstractDevFixtures
{
    /**
     * @var array<MultiReferenceEntityParent>
     */
    public array $parentEntities = [];

    public function load(ObjectManager $manager): void
    {
        $this->loadParent(manager: $manager);
        $this->loadChildren(manager: $manager);
    }

    public function loadParent(ObjectManager $manager): void
    {
        $entitiesProperties = [
            [
                'firstname' => 'First multi reference firstname',
                'lastname' => 'First multi reference lastname',
            ],
            [
                'firstname' => 'Second multi reference firstname',
                'lastname' => 'Second multi reference lastname',
            ],
            [
                'firstname' => 'Third multi reference firstname',
                'lastname' => 'Third multi reference lastname',
            ],
        ];

        foreach ($entitiesProperties as $entityProperties) {
            $entity = (new MultiReferenceEntityParent())
                ->setFirstname($entityProperties['firstname'])
                ->setLastname($entityProperties['lastname'])
            ;

            $manager->persist($entity);
            $this->parentEntities[] = $entity;
        }

        $manager->flush();
    }

    public function loadChildren(ObjectManager $manager): void
    {
        $entitiesProperties = [
            [
                'title' => 'First multi reference title',
                'owners' => [
                    $this->parentEntities[0],
                ],
            ],
            [
                'title' => 'Second multi reference title',
                'owners' => [
                    $this->parentEntities[0],
                    $this->parentEntities[1],
                ],
            ],
            [
                'title' => 'Third multi reference title',
                'owners' => [
                    $this->parentEntities[0],
                    $this->parentEntities[1],
                    $this->parentEntities[2],
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
}
