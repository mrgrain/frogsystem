<?php
namespace App\Services;

use Dflydev\DotAccessData\DataInterface;
use Frogsystem\Metamorphosis\Services\FileConfig;
use Illuminate\Database\ConnectionResolverInterface;

class DatabaseConfig extends FileConfig
{
    public function __construct(DataInterface $data, ConnectionResolverInterface $db, $path)
    {
        parent::__construct($data, $path);
        $this->db = $db;
        $configs = $db->connection()->table('config')->select('*')->get();
        foreach ($configs as $config) {
            $this->set($config->config_name, json_decode($config->config_data, true));
        }
    }

}
