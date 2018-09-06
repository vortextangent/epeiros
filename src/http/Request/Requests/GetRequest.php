<?php
namespace Epeiros\Http;

class GetRequest extends Request
{
    public function isGetRequest()
    {
        return true;
    }
}
