<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\PostController;
use Somecode\Framework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostController::class, 'show']),
    Route::get('/hi/{name}', function (string $name) {
        return new \Somecode\Framework\Http\Responce("Hello {$name}!");
    }),
];
