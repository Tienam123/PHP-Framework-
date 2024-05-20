<?php

declare(strict_types=1);

namespace Somecode\Framework\Controller;

use Psr\Container\ContainerInterface;
use Somecode\Framework\Http\Responce;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function render(string $view, array $parameters = [], ?Responce $responce = null): Responce
    {
        $content = $this->container->get('twig')->render($view, $parameters);
        $responce ??= new Responce();

        $responce->setContent($content);

        return $responce;
    }
}
