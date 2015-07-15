<?php
namespace App\Providers;

use Frogsystem\Legacy\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function plugin()
    {
        $this->app['Frogsystem\Metamorphosis\Contracts\ConfigInterface']
            = $this->app->one('App\Services\DatabaseConfig');
    }
}
