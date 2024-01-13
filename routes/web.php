<?php


use App\Controllers\HomeController;
use App\Controllers\PostController;
use Somecode\Framework\Routing\Route;

return [
    Route::post('/',[HomeController::class,'index']),
    Route::get('/posts/{id:\d+}',[PostController::class,'show']),
    Route::get('/hi/{name}',
        function ($name) {
        return new \Somecode\Framework\Http\Responce("Hello, $name");
    })
];