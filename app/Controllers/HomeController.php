<?php

namespace App\Controllers;

use Somecode\Framework\Http\Responce;

class HomeController
{
    public function index(): Responce
    {
        $content = "<h1>Hello, world!!!!</h1>";
        return new Responce($content);
    }

}