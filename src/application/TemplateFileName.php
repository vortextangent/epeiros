<?php

namespace Epeiros;

class TemplateFileName extends FileName
{
    /**
     * @param string $base
     */
    public function __construct($base)
    {
        parent::__construct($base, "html");
    }
}
