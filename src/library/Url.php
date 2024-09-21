<?php

namespace Vortextangent\Epeiros\library;

use Vortextangent\Epeiros\Http\ParameterCollection;
use Vortextangent\Epeiros\Http\Path;

class Url
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->ensureIsString($url);
        $this->ensureIsInValidFormat($url);

        $this->url = $url;
    }

    /**
     * @param Path $relativeUrlPath
     * @param ParameterCollection $parameters
     * @return Url
     */
    public static function fromRelativePath(Path $relativeUrlPath, ParameterCollection $parameters = null)
    {
        $hostname = $_SERVER['HTTP_HOST'];

        $parametersUrlString = '';
        if ($parameters !== null) {
            $parametersUrlString = $parameters->asUrlString();
        }

        //TODO: revisit this if we need to use https
        $url ="http://" . $hostname . $relativeUrlPath->asString() . $parametersUrlString;

        return new Url($url);
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     */
    private function ensureIsInValidFormat($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException(sprintf("Url is not in a valid format: '%s'", $url));
        }
    }

    /**
     * @param $string
     * @throws InvalidArgumentException
     */
    private function ensureIsString($string)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException(get_class() . " must be a string.");
        }
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }
}
