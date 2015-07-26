<?php
namespace App\Providers;

use Frogsystem\Legacy\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function plugin()
    {
        $this->app['Frogsystem\Metamorphosis\Contracts\ConfigInterface']
            = $this->app->one('App\Services\DatabaseConfig', ['path' => realpath(dirname(dirname(__DIR__)).'/config/database.php')]);
        $this->app['Frogsystem\Metamorphosis\Contracts\ConfigInterface'];
    }
}
