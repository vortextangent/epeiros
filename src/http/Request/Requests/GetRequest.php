<?php
namespace Vortextangent\Epeiros\Http;

class GetRequest extends Request
{
    public function isGetRequest()
    {
        return true;
    }
}
