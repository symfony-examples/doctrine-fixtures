<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

echo "--- Clear cache and old files ---  \n";
exec('rm -rf /var/cache/test');                     # Clear test cache directory.
exec('rm -rf /var/test.db');                        # Remove previous testing database if it exist.
exec('php bin/console --env=test cache:warmup');    # Warmup the cache before executing tests.

/*
 * Bootstrap database :
 * - Create new database.
 * - Run migrations.
 * - Load fixtures.
 */
echo "--- Configure database --- \n";
exec('php bin/console --env=test doctrine:database:create');
exec('php bin/console --env=test doctrine:migration:migrate -n');
exec('php bin/console --env=test doctrine:fixtures:load --group=test -n');

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}
