<?php
namespace App;

use Frogsystem\Metamorphosis\WebApplication;
use Frogsystem\Spawn\Contracts\KernelInterface;
use Frogsystem\Spawn\Contracts\PluggableInterface;
use Interop\Container\ContainerInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\ListFiles;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class Frogsystem2 extends WebApplication
{
    public function __construct(ContainerInterface $delegate = null)
    {
        parent::__construct($delegate);

        // Getting config
        $root = realpath('../');
        @include_once(getenv('FS2CONFIG') ?: $root . '/config/main.php');
        @define('FS2PUBLIC', $root . '/public');
        @define('FS2CONFIG', $root . '/config');

        // Old Vars
        @define('FS2CONTENT', FS2PUBLIC);
        @define('FS2MEDIA', FS2CONTENT . '/media');
        @define('FS2STYLES', FS2CONTENT . '/styles');
        @define('FS2UPLOAD', FS2CONTENT . '/upload');

        // Defaults for other constants
        @define('IS_SATELLITE', false);
        @define('FS2_DEBUG', true);
        @define('FS2_ENV', 'development');

        $filesystem = new Filesystem(new Local($root));
        $filesystem->addPlugin(new ListFiles());
        $this['League\Flysystem\Filesystem'] = $filesystem;
    }

    public function load(KernelInterface $kernel)
    {
        try {
            parent::load($kernel);
        } catch (\Exception $e) {
            $response = $this->terminate(
                $this->get('Psr\Http\Message\ServerRequestInterface'),
                $this->get('Psr\Http\Message\ResponseInterface'),
                $e
            );
            echo $response->getBody();
        }
    }

    public function handle(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        try {
            return parent::handle($request, $response, $next);
        } catch (\Exception $exception) {
            return $next($request, $this->terminate($exception), $next);
        }
    }


    public function connect(PluggableInterface $pluggable)
    {
        // Plug the pluggable in
        $this->pluggables[] = $pluggable;
        $pluggable->plugin();
    }

    public function terminate(\Exception $error = null)
    {
        // get trace
        $trace = $error->getTraceAsString();

        // Exception template
        $template = <<<HTML
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>There was an error with your application</title>
    </head>
    <body>
        <h1>Quak! Something went wrong...</h1>
        <p>
            <b>{$error->getMessage()}</b>
        </p>
        <pre>{$trace}</pre>
    </body>
</html>
HTML;

        // Display error
        return new HtmlResponse($template, 501);
    }

}
