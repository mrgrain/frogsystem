<?php
namespace App\Providers;

use App\Services\DatabaseConfig;
use Frogsystem\Metamorphosis\Contracts\ConfigInterface;
use Frogsystem\Metamorphosis\Providers\ServiceProvider;
use Frogsystem\Spawn\Container;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Registers entries with the container.
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app[ConfigInterface::class] = $app->one(DatabaseConfig::class, [
            'path' => realpath(dirname(dirname(__DIR__)) . '/config/database.php')
        ]);
    }
}
