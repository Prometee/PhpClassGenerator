<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

interface ArrayGetterSetterInterface extends GetterSetterInterface
{
    public const ADD_SETTER_PREFIX = 'add';
    public const HAS_GETTER_PREFIX = 'has';
    public const REMOVE_SETTER_PREFIX = 'remove';

    public function configureAddSetter(string $indent = null): void;

    /**
     * @return array<int, string>
     */
    public function getSingleTypes(): array;

    public function configureRemoveSetter(string $indent = null): void;

    public function configureHasGetter(string $indent = null): void;

    public function getSingleName(): string;

    public function getSingleMethodName(?string $prefix = null, ?string $suffix = null): string;
}
