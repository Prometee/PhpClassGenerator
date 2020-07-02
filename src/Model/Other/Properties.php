<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\AbstractModel;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

class Properties extends AbstractModel implements PropertiesInterface
{
    use UsesAwareTrait;

    /** @var PropertyInterface[] */
    protected $properties = [];

    public function configure(array $properties = []): void
    {
        $this->properties = $properties;
    }

    public function addProperty(PropertyInterface $propertyGenerator): void
    {
        if (!$this->hasProperty($propertyGenerator->getPhpName())) {
            $this->properties[$propertyGenerator->getPhpName()] = $propertyGenerator;
        }
    }

    public function hasProperty(string $name): bool
    {
        return isset($this->properties[$name]);
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    public function getPropertyByName(string $propertyName): ?PropertyInterface
    {
        foreach ($this->properties as $property) {
            if ($property->getName() === $propertyName) {
                return $property;
            }
        }

        return null;
    }
}
