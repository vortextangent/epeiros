<?php

namespace Epeiros\Events;

use Epeiros\Library\LogicException;

class MultipleInstancesOfAggregateDetected extends LogicException implements EventsException
{
}
