<?php

namespace Somecode\Framework\Http;

use Somecode\Framework\Http\Exceptions\HttpException;
use Somecode\Framework\Routing\RouterInterface;


class Kernel
{


    public function __construct(
        private RouterInterface $router
    ) {
        $this->router = $this->router;
    }

    public function handle(Request $request): Responce
    {
        try {
            [
                $routeHandler,
                $vars,
            ] = $this->router->dispatch($request);
            $response = call_user_func_array($routeHandler, $vars);
        }
        catch (HttpException $e) {
            $response = new Responce($e->getMessage(), $e->getStatusCode());
        }
        return $response;
    }
}