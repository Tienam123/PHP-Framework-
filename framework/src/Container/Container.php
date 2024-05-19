<?php

declare(strict_types=1);

namespace Somecode\Framework\Container;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use Somecode\Framework\Container\Exceptions\ContainerExceptions;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object|null $concrete = null)
    {
        if (is_null($concrete)) {
            if (! class_exists($id)) {
                throw new ContainerExceptions("Service $id does not found");
            }

            $concrete = $id;
        }

        $this->services[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (! $this->has($id)) {
            if (! class_exists($id)) {
                throw new ContainerExceptions("Service $id could not be resolved");
            }

            $this->add($id);
        }

        return $this->resolve($this->services[$id]);

    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    private function resolve($class)
    {

        $reflectionClass = new ReflectionClass($class);
        $constructor = $reflectionClass->getConstructor();

        if (is_null($constructor)) {
            return $reflectionClass->newInstance();
        }

        $constructorParams = $constructor->getParameters();

        $classDependencies = $this->resolveClassDependencies($constructorParams);

        return $reflectionClass->newInstanceArgs($classDependencies);
    }

    private function resolveClassDependencies(array $constructorParams)
    {
        $classDependencies = [];

        /**
         * @var \ReflectionParameter $constructorParam
         */
        foreach ($constructorParams as $constructorParam) {
            $serviceType = $constructorParam->getType();
            dd($serviceType);
        }
    }
}
