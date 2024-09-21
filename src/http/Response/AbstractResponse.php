<?php

namespace Vortextangent\Epeiros\Http;

abstract class AbstractResponse implements Response
{
    /**
     * @var SessionId
     */
    private $sessionId;

    /**
     * @return SessionId
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param SessionId $sessionId
     * @return null
     */
    public function setSessionId(SessionId $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function send()
    {
        if (isset($this->sessionId)) {
            setcookie(
                $this->sessionId->getCookieName(),
                $this->sessionId->asString(),
                time() + 60 * 60 * 24,
                '/',
                null,
                isset($_SERVER['HTTPS']),
                true
            );
        }
        $this->doSend();
    }

    abstract protected function doSend();
}
