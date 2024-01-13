<?php

namespace Somecode\Framework\Http;



use Somecode\Framework\Http\Exceptions\HttpException;
use Somecode\Framework\Http\Exceptions\MethodNotAllowedException;
use Somecode\Framework\Http\Exceptions\RouteNotFoundException;
use Somecode\Framework\Routing\RouterInterface;

class Kernel
{
    public function __construct(
        private RouterInterface $router
    )
    {
    }

    public function handle(Request $request)
    {
        try {
            [$routeHandler,$vars] = $this->router->dispatch($request);
            $responce = call_user_func_array($routeHandler,$vars);
        } catch (HttpException $exception) {
            $responce = new Responce($exception->getMessage(),$exception->getStatusCode());
        }
        catch (\Throwable $exception) {
            $responce = new Responce($exception->getMessage(),500);
        }

        return $responce;
    }
}