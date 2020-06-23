<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Class_;

use Prometee\PhpClassGenerator\Model\ModelInterface;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareInterface;

interface ClassInterface extends ModelInterface, UsesAwareInterface, PhpDocAwareInterface
{
    /**
     * @param string $namespace The class namespace
     * @param string $className The class name
     * @param string|null $extendClass The extend class
     * @param array<int, string> $implements The class implements
     */
    public function configure(
        string $namespace,
        string $className,
        ?string $extendClass = null,
        array $implements = []
    ): void;

    public function getTraits(): TraitsInterface;

    public function setProperties(PropertiesInterface $propertiesGenerator): void;

    public function setTraits(TraitsInterface $traitsGenerator): void;

    public function getType(): string;

    public function getMethods(): MethodsInterface;

    public function setMethods(MethodsInterface $methodsGenerator): void;

    public function setNamespace(string $namespace): void;

    public function getNamespace(): string;

    /**
     * @return array<int, string>
     */
    public function getImplements(): array;

    public function getClassName(): string;

    public function getExtendClassName(): ?string;

    public function setExtendClassName(?string $extendClassName): void;

    /**
     * @param array<int, string> $implements
     */
    public function setImplements(array $implements): void;

    public function getProperties(): PropertiesInterface;

    public function setExtendClass(?string $extendClass): void;

    public function setClassName(string $className): void;
}
