<?php

namespace Somecode\Framework\Http;

use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function __construct()
    {
    }

    public function handle(Request $request): Responce
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $routes = include BASE_PATH.'/routes/web.php';

            dd($routes);
            $collector->get('/', function () {
                $content = "<h1>Hello, to you!</h1>";
                return new Responce($content);
            });

            $collector->get('/posts/{id}', function (array $vars) {
                $content = "<h1>Post {$vars['id']}</h1>";

                return new Responce($content);
            });
        });


        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        [
            $status,
            $handler,
            $vars,
        ] = $routeInfo;

        return $handler($vars);
    }
}