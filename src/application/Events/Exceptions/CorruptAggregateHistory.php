<?php

namespace Epeiros\Events;

use Epeiros\Library\LogicException;

class CorruptAggregateHistory extends LogicException implements EventsException
{
}
