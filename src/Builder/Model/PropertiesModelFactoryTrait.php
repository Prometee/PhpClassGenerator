<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Property\ConstantModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Property\ConstantModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\PropertyModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Property\PropertyModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Property\Constant;
use Prometee\PhpClassGenerator\Model\Property\Property;

trait PropertiesModelFactoryTrait
{
    /** @var PropertyModelFactoryInterface */
    private $propertyModelFactory;
    /** @var ConstantModelFactoryInterface */
    private $constantModelFactory;

    /** @var string */
    private $propertyModelFactoryClass = PropertyModelFactory::class;
    /** @var string */
    private $constantModelFactoryClass = ConstantModelFactory::class;


    /** @var string */
    private $propertyClass = Property::class;
    /** @var string */
    private $constantClass = Constant::class;

    abstract public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface;

    public function buildPropertyModelFactory(): PropertyModelFactoryInterface
    {
        if (null === $this->propertyModelFactory) {
            $this->propertyModelFactory = new $this->propertyModelFactoryClass(
                $this->propertyClass,
                $this->buildPhpDocModelFactory()
            );
        }

        return $this->propertyModelFactory;
    }

    public function buildConstantModelFactory(): ConstantModelFactoryInterface
    {
        if (null === $this->constantModelFactory) {
            $this->constantModelFactory = new $this->constantModelFactoryClass(
                $this->constantClass,
                $this->buildPropertyModelFactory()
            );
        }

        return $this->constantModelFactory;
    }

    public function getPropertyModelFactoryClass(): string
    {
        return $this->propertyModelFactoryClass;
    }

    public function setPropertyModelFactoryClass(string $propertyModelFactoryClass): void
    {
        $this->propertyModelFactoryClass = $propertyModelFactoryClass;
    }

    public function getConstantModelFactoryClass(): string
    {
        return $this->constantModelFactoryClass;
    }

    public function setConstantModelFactoryClass(string $constantModelFactoryClass): void
    {
        $this->constantModelFactoryClass = $constantModelFactoryClass;
    }

    public function getPropertyClass(): string
    {
        return $this->propertyClass;
    }

    public function setPropertyClass(string $propertyClass): void
    {
        $this->propertyClass = $propertyClass;
    }

    public function getConstantClass(): string
    {
        return $this->constantClass;
    }

    public function setConstantClass(string $constantClass): void
    {
        $this->constantClass = $constantClass;
    }
}