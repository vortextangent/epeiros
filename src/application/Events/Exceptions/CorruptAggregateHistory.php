<?php

namespace Vortextangent\Epeiros\Events;

use Vortextangent\Epeiros\Library\LogicException;

class CorruptAggregateHistory extends LogicException implements EventsException
{
}
