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

    public function getMethodName(?string $prefix = null, ?string $suffix = null): string;

    public function configureSetter(string $indent = null): void;

    public function configureGetter(string $indent = null): void;

    /**
     *
     * @param string|null $indent
     *
     * @return MethodInterface[]
     */
    public function getMethods(string $indent = null): array;

    public function getGetterMethod(): MethodInterface;

    public function setGetterMethod(MethodInterface $getterMethod): void;

    public function getSetterMethod(): MethodInterface;

    public function setSetterMethod(MethodInterface $setterMethod): void;
}
