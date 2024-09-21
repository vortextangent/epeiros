<?php

namespace Vortextangent\Epeiros;

use Vortextangent\Epeiros\Http\SessionId;

class ApplicationStateFileName extends FileName
{
    /**
     * @param SessionId $sessionId
     */
    public function __construct(SessionId $sessionId)
    {
        parent::__construct((string) $sessionId, 'state');
    }
}
