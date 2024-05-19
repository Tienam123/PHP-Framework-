<?php

namespace Somecode\Framework\Http;

class Responce
{
    public function __construct(
        private mixed $content,
        private int $status = 200,
        private array $headers = [],
    ) {
        http_response_code($this->status);
    }

    public function send()
    {

        echo $this->content;
    }
}