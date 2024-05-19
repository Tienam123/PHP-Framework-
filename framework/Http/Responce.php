<?php

namespace Somecode\Framework\Http;

class Responce
{
    public function __construct(
        private mixed $content,
        private int $status = 200,
        private array $headers = [],
    ) {
    }

    public function send()
    {
        echo $this->content;
    }
}