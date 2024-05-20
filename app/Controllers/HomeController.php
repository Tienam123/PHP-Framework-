<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\YoutubeService;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Responce;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly YoutubeService $youtubeService,
    ) {
    }

    public function index(): Responce
    {

        return $this->render('home.html.twig', [
            'youTubeChannel' => $this->youtubeService->getChannelUrl(),
        ]);
    }
}
