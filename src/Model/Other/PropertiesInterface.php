<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

interface PropertiesInterface extends ModelInterface, UsesAwareInterface
{
    /**
     * @param PropertyInterface[] $properties
     */
    public function configure(array $properties = []): void;

    public function addProperty(PropertyInterface $propertyGenerator): void;

    public function hasProperty(string $name): bool;

    /**
     * @param PropertyInterface[] $properties
     */
    public function setProperties(array $properties): void;

    public function getPropertyByName(string $propertyName): ?PropertyInterface;

    /**
     * @return PropertyInterface[]
     */
    public function getProperties(): array;
}
