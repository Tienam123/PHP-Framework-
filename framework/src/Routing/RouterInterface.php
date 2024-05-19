<?php

declare(strict_types=1);

namespace Somecode\Framework\Routing;

use Somecode\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}
