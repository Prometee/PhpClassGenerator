<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\Method\GetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\IsserSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

class PropertyMethods implements PropertyMethodsInterface
{
    use UsesAwareTrait {
        UsesAwareTrait::__construct as private __constructUses;
    }
    /** @var IsserSetterModelFactoryInterface */
    protected $isserSetterModelFactory;
    /** @var GetterSetterModelFactoryInterface */
    protected $getterSetterModelFactory;

    /** @var PropertyInterface */
    protected $property;
    /** @var bool */
    protected $readOnly = false;
    /** @var bool */
    protected $writeOnly = false;

    public function __construct(
        UsesInterface $uses,
        IsserSetterModelFactoryInterface $isserSetterModelFactory,
        GetterSetterModelFactoryInterface $getterSetterModelFactory
    ) {
        $this->__constructUses($uses);
        $this->isserSetterModelFactory = $isserSetterModelFactory;
        $this->getterSetterModelFactory = $getterSetterModelFactory;
    }

    public function configure(
        PropertyInterface $property,
        bool $readOnly = false,
        bool $writeOnly = false
    ): void {
        $this->property = $property;
        $this->readOnly = $readOnly;
        $this->writeOnly = $writeOnly;
    }

    public function getMethods(string $indent = null): array
    {
        $propertyMethods = null;
        if (null !== $this->property->getTypes()) {
            foreach ($this->property->getTypes() as $type) {
                if ('bool' === $type) {
                    $propertyMethods = $this->isserSetterModelFactory->create($this->uses);
                    break;
                }
                if (preg_match('#\[]$#', $type)) {
                    $propertyMethods = $this->getterSetterModelFactory->create($this->uses);
                    break;
                }
            }
        }

        if (null === $propertyMethods) {
            $propertyMethods = $this->getterSetterModelFactory->create($this->uses);
        }

        $propertyMethods->configure(
            $this->property,
            $this->readOnly,
            $this->writeOnly
        );

        return $propertyMethods->getMethods($indent);
    }

    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }

    public function setReadOnly(bool $readOnly): void
    {
        $this->readOnly = $readOnly;
    }

    public function isWriteOnly(): bool
    {
        return $this->writeOnly;
    }

    public function setWriteOnly(bool $writeOnly): void
    {
        $this->writeOnly = $writeOnly;
    }
}
