<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Responce;


$request = Request::createFromGlobals();


$content = "<h1>Hello, world!!</h1>";
$responce = new Responce($content, 200, []);
$responce->send();