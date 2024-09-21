<?php

namespace Vortextangent\Epeiros;

use PDO;

class AppConfig
{
    private array $config;

    public function __construct(array $configuration)
    {
        $this->config = $configuration;
    }

    public function database(): PDO
    {
        return EpeirosDatabase::getInstance($this->config['system']['database']);
    }

}
