<?php
namespace Vortextangent\Epeiros\Http;

class OkStatusHeader implements StatusHeader
{
    public function send()
    {
        header('HTTP/1.1 200 OK');
    }
}
