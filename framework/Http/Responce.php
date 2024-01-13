<?php

namespace Somecode\Framework\Http;

class Responce
{
    public function __construct(
        private mixed $content,
        private mixed $statusCode = 200,
        private mixed $headers = [],
    )
    {
        http_response_code($this->statusCode);
    }

    public function send()
    {
        echo $this->content;
    }

}