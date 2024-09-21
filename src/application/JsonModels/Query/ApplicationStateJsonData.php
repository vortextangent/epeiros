<?php

namespace Vortextangent\Epeiros\Query;

use Vortextangent\Epeiros\Http\JsonData;

class ApplicationStateJsonData implements JsonData
{
    /**
     * @var string
     */
    private $applicationState;

    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var string
     */
    private $loggedIn;

    /**
     * @param string $applicationState
     * @param string $sessionId
     * @param string $loggedIn
     */
    public function __construct($applicationState, $sessionId, $loggedIn)
    {
        $this->applicationState = $applicationState;
        $this->sessionId        = $sessionId;
        $this->loggedIn         = $loggedIn;
    }

    /**
     * @return string
     */
    public function applicationState()
    {
        return $this->applicationState;
    }

    /**
     * @return string
     */
    public function sessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return string
     */
    public function loggedIn()
    {
        return $this->loggedIn;
    }
}
