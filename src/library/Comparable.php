<?php
namespace Vortextangent\Epeiros\library;

interface Comparable
{
    /**
     * @param Comparable $other
     *
     * @return bool
     */
    public function equalTo(Comparable $other);
}
