<?php

declare(strict_types=1);

namespace App\DataFixtures\Dev;

use App\DataFixtures\AppEnvFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

abstract class AbstractDevFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return [
            AppEnvFixtures::Dev->value,
        ];
    }
}
