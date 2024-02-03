<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinition(array $newDefinition)
    {

        $this->definitions = [...$this->definitions, ...$newDefinition];
    }

    public function resolve(string $className)
    {
        $refelctionClass = new ReflectionClass($className);
        if (!$refelctionClass->isInstantiable()) {
            throw new ContainerException("class {$className} is not instantiable!");
        }

        $construct = $refelctionClass->getConstructor();


        if (!$construct) {
            return new $className;
        }

        $params = $construct->getParameters();


        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("failed to resolve class {$className} because  param {$name} is misiing a type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name.");
            }



            $dependencies[] = $this->get($type->getName());
        }

        return $refelctionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exist in container.");
        }

        $factory = $this->definitions[$id];

        $dependency = $factory($this);

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
