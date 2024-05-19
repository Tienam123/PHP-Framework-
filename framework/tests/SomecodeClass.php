<?php

declare(strict_types=1);

namespace Somecode\Framework\Tests;

class SomecodeClass
{
    public function __construct(
        private readonly AreaClass $areaClass
    ) {
    }

    public function getAreaClass(): AreaClass
    {
        return $this->areaClass;
    }
}
