<?php
require_once dirname(__DIR__).'/vendor/autoload.php';
define('BASE_PATH',dirname(__DIR__));


use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Routing\Router;


$request = Request::createFromGlobals();

$router = new Router();

$kernel = new Kernel($router);

$responce = $kernel->handle($request);
$responce->send();


