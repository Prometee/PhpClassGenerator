<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;

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
}
