<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\ModelInterface;

interface MethodsInterface extends ModelInterface, UsesAwareInterface
{
    /**
     * @param MethodInterface[] $methods
     */
    public function configure(array $methods = []): void;

    /**
     * @param MethodInterface[] $methods
     */
    public function addMultipleMethod(array $methods): void;

    public function addMethod(MethodInterface $method): void;

    public function getMethodByName(string $name): ?MethodInterface;

    public function hasMethod(string $name): bool;

    /**
     * @return MethodInterface[]
     */
    public function getMethods(): array;

    /**
     * @param MethodInterface[] $methods
     */
    public function setMethods(array $methods): void;
}
