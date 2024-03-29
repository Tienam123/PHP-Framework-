<?php

namespace Somecode\Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Somecode\Framework\Http\Exceptions\MethodNotAllowedException;
use Somecode\Framework\Http\Exceptions\RouteNotFoundException;
use Somecode\Framework\Http\Request;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    public function dispatch(Request $request): array
    {
        [$handler,$vars] = $this->extractRouteInfo($request);
        if (is_array($handler)) {
            [$controller,$method] = $handler;
            $handler = [new $controller, $method];
        }

        return [$handler,$vars];
    }
    private function extractRouteInfo(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $routes = require_once BASE_PATH.'/routes/web.php';
            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }
        });
        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [$routeInfo[1],$routeInfo[2]];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(',',$routeInfo[1]);
                $exception =  new MethodNotAllowedException("Supported HTTP methods: $allowedMethods");
                $exception->setStatusCode(405);
                throw $exception;
            default:
                $exception =  new RouteNotFoundException('Route not Found');
                $exception->setStatusCode(404);
                throw $exception;
        }
    }
}