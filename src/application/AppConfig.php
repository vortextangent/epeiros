<?php

namespace Epeiros;

use mysqli;

class AppConfig
{

    /**
     * @var array
     */
    private $config;

    /**
     * @param array $configuration
     */
    public function __construct($configuration)
    {
        $this->config = $configuration;
    }

    /**
     * @return mysqli
     */
    public function database()
    {
        return EpeirosDatabase::getInstance($this->config['system']['database']);
    }

}
