<?php

declare(strict_types=1);

namespace Somecode\Framework\Http;

class Responce
{
    public function __construct(
        private string $content = '',
        private int $status = 200,
        private array $headers = [],
    ) {
        http_response_code($this->status);
    }

    public function send()
    {

        echo $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
