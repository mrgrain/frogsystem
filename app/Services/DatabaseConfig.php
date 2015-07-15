<?php
namespace App\Services;

use Dflydev\DotAccessData\DataInterface;
use Frogsystem\Metamorphosis\Services\FileConfig;
use Illuminate\Database\ConnectionResolverInterface;
use League\Flysystem\Filesystem;

class DatabaseConfig extends FileConfig
{
    public function __construct(DataInterface $data, Filesystem $filesystem, ConnectionResolverInterface $db)
    {
        parent::__construct($data, $filesystem);
        $this->db = $db;
    }

}
