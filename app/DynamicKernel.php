<?php
namespace App;

use Frogsystem\Metamorphosis\Kernels\WebApplicationKernel;

/**
 * Class Kernel
 * @package frogsystem\metamorphosis
 */
class DynamicKernel extends WebApplicationKernel
{
    /**
     * @var array
     */
    protected $middleware = [];

    /**
     * @var array
     */
    protected $pluggables = [
        'Frogsystem\Legacy\Legacy'
    ];
}
