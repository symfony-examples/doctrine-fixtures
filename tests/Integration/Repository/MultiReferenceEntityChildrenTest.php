<?php

declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\MultiReferenceEntityChildren;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class MultiReferenceEntityChildrenTest extends KernelTestCase
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

        $this->objectRepository = $manager->getRepository(MultiReferenceEntityChildren::class);
    }

    public function testCountFindAll(): void
    {
        $all = $this->objectRepository->findAll();

        self::assertCount(
            expectedCount: 3,
            haystack: $all
        );
    }

    /**
     * @dataProvider persistedEntityData
     */
    public function testPersistedEntity(string $title, int $expectedOwners): void
    {
        $entity = $this->objectRepository->findOneBy(criteria: ['title' => $title]);

        self::assertInstanceOf(
            expected: MultiReferenceEntityChildren::class,
            actual: $entity
        );

        self::assertCount(
            expectedCount: $expectedOwners,
            haystack: $entity->getOwners()
        );
    }

    /**
     * Data provider for method testPersistedEntity.
     *
     * @return array<int, array<int, int|string>>
     */
    public function persistedEntityData(): array
    {
        return [
            [
                'First multi reference title',
                1,
            ],
            [
                'Second multi reference title',
                2,
            ],
            [
                'Third multi reference title',
                3,
            ],
            ];
    }
}
