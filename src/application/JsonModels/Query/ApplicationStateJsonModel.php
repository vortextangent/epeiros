<?php

namespace Vortextangent\Epeiros\Query;

use Vortextangent\Epeiros\App\ApplicationState;
use Vortextangent\Epeiros\Http\JsonModel;

class ApplicationStateJsonModel extends JsonModel
{
    /**
     * @var ApplicationState
     */
    private $applicationState;

    /**
     * @var ApplicationStateJsonData
     */
    private $data;

    public function __construct(ApplicationState $applicationState)
    {
        $this->applicationState = $applicationState;

        $this->data = new ApplicationStateJsonData($this->rawData(), $this->sessionId(), $this->loggedIn());
    }

    public function data()
    {
        return $this->data;
    }

    private function sessionId()
    {
        return $this->applicationState->getSessionId()->asString();
    }

    private function loggedIn()
    {
        if ($this->applicationState->isLoggedIn()) {
            $message = "Logged In";
        } else {
            $message = "Guest";
        }

        return $message;
    }

    private function rawData()
    {
        return var_export($this->applicationState, true);
    }
}
