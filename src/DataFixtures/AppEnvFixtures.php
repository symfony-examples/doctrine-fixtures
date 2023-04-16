<?php

declare(strict_types=1);

namespace App\DataFixtures;

/**
 * Provide a list of fixtures envs.
 */
enum AppEnvFixtures: string
{
    case Dev = 'dev';
    case Test = 'test';
}
