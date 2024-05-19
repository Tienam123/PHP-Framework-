<?php

declare(strict_types=1);

namespace App\Controllers;

use Somecode\Framework\Http\Responce;

class PostController
{
    public function show(int $id): Responce
    {
        $content = "<h1>Post - {$id}</h1>";

        return new Responce($content);
    }
}
