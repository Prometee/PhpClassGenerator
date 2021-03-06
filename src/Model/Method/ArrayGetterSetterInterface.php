<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

interface ArrayGetterSetterInterface extends GetterSetterInterface
{
    public const ADD_SETTER_PREFIX = 'add';
    public const HAS_GETTER_PREFIX = 'has';
    public const REMOVE_SETTER_PREFIX = 'remove';

    public function configureAddSetter(): void;

    /**
     * @return array<int, string>
     */
    public function getSingleTypes(): array;

    public function configureRemoveSetter(): void;

    public function configureHasGetter(): void;

    public function getSingleName(): string;

    public function getSingleMethodName(?string $prefix = null, ?string $suffix = null): string;

    public function getHasGetterMethod(): MethodInterface;

    public function setHasGetterMethod(MethodInterface $hasGetterMethod): void;

    public function getAddSetterMethod(): MethodInterface;

    public function setAddSetterMethod(MethodInterface $addSetterMethod): void;

    public function getRemoveSetterMethod(): MethodInterface;

    public function setRemoveSetterMethod(MethodInterface $removeSetterMethod): void;
}
