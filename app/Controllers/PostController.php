<?php

declare(strict_types=1);

namespace App\Controllers;

use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Responce;

class PostController extends AbstractController
{
    public function show(int $id): Responce
    {
        return $this->render('posts.html.twig', [
            'id' => $id,
        ]);
    }
}
