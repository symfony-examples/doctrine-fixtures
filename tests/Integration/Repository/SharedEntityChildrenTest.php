<?php

declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\SharedEntityChildren;
use App\Entity\SharedEntityParent;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SharedEntityChildrenTest extends KernelTestCase
{
    private ObjectRepository $objectRepository;

    public function setup(): void
    {
        $kernel = self::bootKernel();
        $doctrine = $kernel->getContainer()->get(id: 'doctrine');

        if (!$doctrine instanceof Registry) {
            throw new \Exception(message: 'Failed to load doctrine container');
        }

        $manager = $doctrine->getManager();

        if (!$manager instanceof EntityManagerInterface) {
            throw new \Exception(message: 'Failed to load manager');
        }

        $this->objectRepository = $manager->getRepository(SharedEntityChildren::class);
    }

    public function testCountFindAll(): void
    {
        $all = $this->objectRepository->findAll();

        self::assertCount(
            expectedCount: 2,
            haystack: $all
        );
    }

    public function testPersistedEntity(): void
    {
        $entity = $this->objectRepository->findOneBy(criteria: ['title' => 'first shared children']);

        self::assertInstanceOf(
            expected: SharedEntityChildren::class,
            actual: $entity
        );

        self::assertInstanceOf(
            expected: SharedEntityParent::class,
            actual: $entity->getOwner()
        );
    }
}
