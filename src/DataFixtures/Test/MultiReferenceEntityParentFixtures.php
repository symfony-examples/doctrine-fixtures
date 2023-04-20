<?php

declare(strict_types=1);

namespace App\DataFixtures\Test;

use App\Entity\MultiReferenceEntityParent;
use Doctrine\Persistence\ObjectManager;

final class MultiReferenceEntityParentFixtures extends AbstractTestFixtures
{
    public function load(ObjectManager $manager): void
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
        }

        $manager->flush();
    }
}
