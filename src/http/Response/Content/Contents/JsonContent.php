<?php

namespace Vortextangent\Epeiros\Http;

use Vortextangent\Epeiros\Library\InvalidArgumentException;

class JsonContent implements Content
{
    /**
     * @var string
     */
    private $json;

    /**
     * @param string $json
     */
    public function __construct($json)
    {
        $this->ensureIsValidJson($json);

        $this->json = $json;
    }

    private function ensureIsValidJson($json)
    {
        json_decode($json);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new InvalidArgumentException;
        }
    }

    public function send()
    {
        header('Content-Type: application/json');

        print $this->json;
    }

    /**
     * @return string
     */
    public function asString() {
        return $this->json;
    }
}
