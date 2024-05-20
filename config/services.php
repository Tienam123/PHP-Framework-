<?php

declare(strict_types=1);

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Routing\Router;
use Somecode\Framework\Routing\RouterInterface;
use Symfony\Component\Dotenv\Dotenv;

$dotEnv = new Dotenv();
$dotEnv->load(BASE_PATH.'/.env');

//Application parameters
$routes = include BASE_PATH.'/routes/web.php';

//Application services

$container = new Container();
$container->delegate(new ReflectionContainer());

$appEnv = $_ENV['APP_ENV'] ?? 'local';

$container->add('APP_ENV', [$appEnv]);

$container->add(RouterInterface::class, Router::class);
$container->extend(RouterInterface::class)->addMethodCall('registerRoutes', [new ArrayArgument($routes)]);

$container->add(Kernel::class)->addArgument(RouterInterface::class)->addArgument($container);

return $container;
