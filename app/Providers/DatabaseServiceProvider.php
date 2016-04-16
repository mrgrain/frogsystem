<?php
namespace App\Providers;

use Frogsystem\Metamorphosis\Providers\ServiceProvider;
use Frogsystem\Metamorphosis\Services\FileConfig;
use Frogsystem\Spawn\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\ConnectionResolverInterface;

/**
 * Class DatabaseServiceProvider
 * @package App\Providers
 */
class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @var Capsule
     */
    protected $capsule;

    /**
     * @param Capsule $capsule
     */
    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    /**
     * Registers entries with the container.
     * @param Container $app
     */
    public function register(Container $app)
    {
        // Add connection settings deferred to first usage
        $app[ConnectionResolverInterface::class] = $app->once(function () use ($app) {
            $config = $app->make(FileConfig::class, [
                'path' => realpath(dirname(dirname(__DIR__)) . '/config/database.php')
            ]);
            $this->capsule->addConnection($config->get('database.' . $config->get('database.connection')));
            return $this->capsule->getDatabaseManager();
        });
    }
}
