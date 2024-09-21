<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Library\AbstractCollection;

class ParameterCollection extends AbstractCollection
{

    /**
     * @param Parameter $parameter
     */
    public function add(Parameter $parameter)
    {
        $this->elements[$parameter->getIdentifier()->asString()] = $parameter;
    }

    /**
     * @param array $parameters
     *
     * @return ParameterCollection
     */
    public static function fromArray(array $parameters)
    {
        $collection = new static;

        foreach ($parameters as $name => $value) {
            $collection->add(new Parameter(new ParameterIdentifier($name), $value));
        }

        return $collection;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasParameterByName($name)
    {
        return $this->hasElementByIdentifier(new ParameterIdentifier($name));
    }

    /**
     * @param string $name
     *
     * @return string|array
     */
    public function getValueByName($name)
    {
        return $this->getParameterByName($name)->getValue();
    }

    /**
     * @return Parameter[]
     */
    public function getParameters()
    {
        return $this->elements;
    }

    /**
     * @return string
     */
    public function asUrlString()
    {
        $urlString = '';
        if ($this->elements !== null) {
            $i = 0;
            /** @var Parameter $parameter */
            foreach ($this->elements as $parameter) {
                if ($i == 0) {
                    $urlString .= "?" . urlencode($parameter->getIdentifier()->asString());
                } else {
                    $urlString .= "&" . urlencode($parameter->getIdentifier()->asString());
                }
                $urlString .= "=" . urlencode($parameter->getValue());

                $i++;
            }
        }

        return $urlString;
    }

    /**
     * @param $name
     *
     * @return Parameter
     */
    public function getParameterByName($name)
    {
        return $this->getElementByIdentifier(new ParameterIdentifier($name));

    }

}
