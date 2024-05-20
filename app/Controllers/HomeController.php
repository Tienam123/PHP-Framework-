<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\YoutubeService;
use Somecode\Framework\Http\Responce;

class HomeController
{
    public function __construct(
        private readonly YoutubeService $youtubeService,
    ) {
    }

    public function index(): Responce
    {
        $content = '<h1>Hello, world!!!!</h1>';
        $content .= "</br> <a href={$this->youtubeService->getChannelUrl()}>{$this->youtubeService->getChannelUrl()}</a>";

        return new Responce($content);
    }
}
