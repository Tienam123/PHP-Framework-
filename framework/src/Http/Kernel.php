<?php

declare(strict_types=1);

namespace Somecode\Framework\Http;

use League\Container\Container;
use Somecode\Framework\Http\Exceptions\HttpException;
use Somecode\Framework\Routing\RouterInterface;

class Kernel
{
    private $appEnv = 'local';

    public function __construct(
        private RouterInterface $router,
        private Container $container,
    ) {
        $this->appEnv = $this->container->get('APP_ENV');
    }

    public function handle(Request $request): Responce
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);
            $response = call_user_func_array($routeHandler, $vars);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponce($e);
        }

        return $response;
    }

    private function createExceptionResponce(\Exception $e)
    {
        if (in_array('local', $this->appEnv)) {
            throw $e;
        }
        if ($e instanceof HttpException) {
            return new Responce($e->getMessage(), $e->getStatusCode());
        }

        return new Responce('Server error', 500);
    }
}
