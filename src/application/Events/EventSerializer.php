<?php

namespace Epeiros\Events;

class EventSerializer
{
    /**
     * @param Event $event
     * @return string
     */
    public function serialize(Event $event)
    {
        return json_encode($this->restructure($event));
    }

    /**
     * @param $var
     * @return \stdClass|string
     */
    private function restructure($var)
    {
        if (is_object($var)) {
            $class = new \stdClass;

            if (method_exists($var, 'asString')) {
                return $var->asString();
            }
            if (method_exists($var, 'asInt')) {
                return (string) $var->asInt();
            }

            foreach (get_class_methods($var) as $method) {
                if (strpos($method, '__') === 0) {
                    continue;
                }
                if ($method === 'belongsToAggregateType') {
                    continue;
                }
                if ($method === 'aggregateId') {
                    //TODO: think about if there's a better way to handle this, performance-wise it's faster than reflection
                    $longClassName = get_class($var->$method());
                    $shortClassName = lcfirst(substr($longClassName, strrpos($longClassName, '\\')+1));

                    $class->{$shortClassName} = $this->restructure($var->$method());
                    continue;
                }
                if (($method === 'createSuccessInstance')||($method === 'createFailureInstance')) {
                    continue;
                }
                if (substr($method, 0, 3) === 'set') {
                    continue;
                }
                if ($method === 'equals') {
                    continue;
                }

                $result = $var->$method();
                if ($result === null) {
                    continue;
                }
                if (is_object($result)) {
                    $longClassName  = get_class($result);
                    if ($longClassName == 'DateTimeImmutable') {
                        /** @var \DateTimeImmutable $result */
                        $class->{$method} = $result->format('m-d-Y H:i:s');
                        continue;
                    }
                }

                $class->{$method} = $this->restructure($result);
            }

            return $class;
        }

        return $var;
    }
}
