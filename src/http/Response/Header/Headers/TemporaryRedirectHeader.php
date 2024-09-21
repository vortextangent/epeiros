<?php
namespace Vortextangent\Epeiros\Http;

class TemporaryRedirectHeader implements Header
{
    /**
     * @var Path
     */
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function send()
    {
        header('Location: ' . $this->path->asString(), 302);
    }
}
