<?php

namespace Vortextangent\Epeiros\Http;

class ContentResponse extends AbstractResponse
{
    private StatusHeader $statusHeader;

    private Content $content;

    /**
     * @param StatusHeader $statusHeader
     * @param Content $content
     */
    public function __construct(StatusHeader $statusHeader, Content $content)
    {
        $this->statusHeader = $statusHeader;
        $this->content = $content;
    }

    protected function doSend(): void
    {
        $this->statusHeader->send();
        $this->content->send();
    }

    public function getStatusHeader(): StatusHeader
    {
        return $this->statusHeader;
    }

    public function getContent(): Content
    {
        return $this->content;
    }
}
