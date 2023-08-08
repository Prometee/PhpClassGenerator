<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

interface GetterSetterInterface extends UsesAwareInterface
{
    public const GETTER_PREFIX = 'get';
    public const SETTER_PREFIX = 'set';

    public function supports(PropertyInterface $propertyGenerator): bool;

    public function configure(PropertyInterface $propertyGenerator): void;

    /**
     * @return MethodInterface[]
     */
    public function getMethods(): array;

    public function getGetterMethod(): MethodInterface;

    public function setGetterMethod(MethodInterface $getterMethod): void;

    public function getSetterMethod(): MethodInterface;

    public function setSetterMethod(MethodInterface $setterMethod): void;
}
