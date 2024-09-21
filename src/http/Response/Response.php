<?php
namespace Vortextangent\Epeiros\Http;

interface Response
{
    public function send();

    /**
     * @param SessionId $sessionId
     * @return null
     */
    public function setSessionId(SessionId $sessionId);

    /**
     * @return SessionId
     */
    public function getSessionId();
}
