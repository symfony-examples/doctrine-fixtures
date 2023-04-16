<?php

declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\SimpleEntity;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SimpleEntityRepositoryTest extends KernelTestCase
{
    private ObjectRepository $objectRepository;

    public function setup(): void
    {
        $kernel = self::bootKernel();
        $doctrine = $kernel->getContainer()->get('doctrine');

        if (!$doctrine instanceof Registry) {
            throw new \Exception('Failed to load doctrine container');
        }

        $manager = $doctrine->getManager();

        if (!$manager instanceof EntityManagerInterface) {
            throw new \Exception('Failed to load manager');
        }

        $this->objectRepository = $manager->getRepository(SimpleEntity::class);
    }

    public function testCountFindAll(): void
    {
        $all = $this->objectRepository->findAll();

        self::assertCount(
            expectedCount: 1,
            haystack: $all
        );
    }

    public function testPersistedEntity(): void
    {
        $entity = $this->objectRepository->findOneBy(['title' => 'Simple entity title for test purpose']);

        self::assertInstanceOf(
            expected: SimpleEntity::class,
            actual: $entity
        );
    }
}
