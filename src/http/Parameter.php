<?php

namespace Epeiros\Http;

use Epeiros\Library\CollectionElement;

class Parameter implements CollectionElement
{

    /**
     * @var ParameterIdentifier
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param ParameterIdentifier $key
     * @param $value
     */
    public function __construct(ParameterIdentifier $key, $value)
    {
        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * @return ParameterIdentifier
     */
    public function getIdentifier()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [$this->key->jsonSerialize() => $this->value];
    }
}
