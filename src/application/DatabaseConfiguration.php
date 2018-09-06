<?php

namespace Epeiros;

use Epeiros\Library\RuntimeException;

class DatabaseConfiguration
{

    private $dsn;

    private $user;

    private $password;

    private $options;

    /**
     * @param $configArray
     */
    public function __construct($configArray)
    {
        $this->ensureValidArray($configArray);

        $this->dsn      = $configArray['dsn'];
        $this->user     = $configArray['user'];
        $this->password = $configArray['password'];
        $this->options  = $configArray['options'];
    }

    /**
     * @return string
     */
    public function dsn()
    {
        return $this->dsn;
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function options()
    {
        return $this->options;
    }

    private function ensureValidArray($configArray)
    {
        if ( ! isset($configArray['dsn'])) {
            throw new RuntimeException('Invalid database configuration: Missing DSN');
        }
        if ( ! isset($configArray['user'])) {
            throw new RuntimeException('Invalid database configuration: Missing User');
        }
        if ( ! isset($configArray['password'])) {
            throw new RuntimeException('Invalid database configuration: Missing Password');
        }
        if ( ! isset($configArray['options'])) {
            throw new RuntimeException('Invalid database configuration: Missing Options');
        }

        return true;
    }
}
