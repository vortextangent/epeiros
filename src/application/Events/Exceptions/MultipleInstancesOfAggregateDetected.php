<?php

namespace Vortextangent\Epeiros\Events;

use Vortextangent\Epeiros\Library\LogicException;

class MultipleInstancesOfAggregateDetected extends LogicException implements EventsException
{
}
