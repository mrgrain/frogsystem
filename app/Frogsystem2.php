<?php
namespace App;

use App\Providers\ConfigServiceProvider;
use App\Providers\DatabaseServiceProvider;
use Frogsystem\Legacy\Bridge\BridgeApplication;
use Frogsystem\Legacy\Bridge\Providers\BridgeServices;
use Frogsystem\Legacy\Legacy;
use Frogsystem\Metamorphosis\Middleware\RouterMiddleware;
use Frogsystem\Metamorphosis\WebApplication;
use Interop\Container\ContainerInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\ListFiles;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class Frogsystem2
 * @package App
 */
class Frogsystem2 extends WebApplication
{
    /**
     * @var array
     */
    private $huggables = [
        DatabaseServiceProvider::class,
        ConfigServiceProvider::class,
        BridgeServices::class,
    ];

    protected $middleware = [
        RouterMiddleware::class,
        BridgeApplication::class,
    ];

    /**
     * Frogsystem2 constructor.
     * @param ContainerInterface|null $delegate
     */
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

        // Logger
        $this[LoggerInterface::class] = $this->one(NullLogger::class);

        // load huggables
        $this->huggables = $this->load($this->huggables);
        $this->groupHug($this->huggables);
    }
}
