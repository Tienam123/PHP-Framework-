<?php
namespace App\Controllers;
use Somecode\Framework\Http\Responce;

class HomeController
{
    public function index() : Responce
    {
        $content = '<h1>Привет от HomeController</h1>';

        return new Responce($content);
    }
}