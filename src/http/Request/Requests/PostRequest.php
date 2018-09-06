<?php
namespace Epeiros\Http;

class PostRequest extends Request
{
    public function isPostRequest()
    {
        return true;
    }
}
