<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Factory\View\Attribute\PropertyViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Attribute\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UseViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Other\UseViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactory;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Attribute\PropertyView;
use Prometee\PhpClassGenerator\View\Class_\ClassView;
use Prometee\PhpClassGenerator\View\Method\MethodParameterView;
use Prometee\PhpClassGenerator\View\Method\MethodView;
use Prometee\PhpClassGenerator\View\Other\MethodsView;
use Prometee\PhpClassGenerator\View\Other\PropertiesView;
use Prometee\PhpClassGenerator\View\Other\TraitsView;
use Prometee\PhpClassGenerator\View\Other\UsesView;
use Prometee\PhpClassGenerator\View\Other\UseView;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocView;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewInterface;

final class ViewFactoryBuilder implements ViewFactoryBuilderInterface
{
    /** @var PhpDocViewFactoryInterface */
    private $phpDocViewFactory;
    /** @var PropertyViewFactoryInterface */
    private $propertyViewFactory;
    /** @var UsesViewFactoryInterface */
    private $usesViewFactory;
    /** @var UseViewFactoryInterface */
    private $useViewFactory;
    /** @var TraitsViewFactoryInterface */
    private $traitsViewFactory;
    /** @var MethodsViewFactoryInterface */
    private $methodsViewFactory;
    /** @var PropertiesViewFactoryInterface */
    private $propertiesViewFactory;
    /** @var MethodParameterViewFactoryInterface */
    private $methodParameterViewFactory;
    /** @var MethodViewFactoryInterface */
    private $methodViewFactory;
    /** @var ClassViewFactoryInterface */
    private $classViewFactory;

    /** @var string */
    private $phpDocViewFactoryClass = PhpDocViewFactory::class;
    /** @var string */
    private $propertyViewFactoryClass = PropertyViewFactory::class;
    /** @var string */
    private $usesViewFactoryClass = UsesViewFactory::class;
    /** @var string */
    private $useViewFactoryClass = UseViewFactory::class;
    /** @var string */
    private $traitsViewFactoryClass = TraitsViewFactory::class;
    /** @var string */
    private $methodsViewFactoryClass = MethodsViewFactory::class;
    /** @var string */
    private $propertiesViewFactoryClass = PropertiesViewFactory::class;
    /** @var string */
    private $methodParameterViewFactoryClass = MethodParameterViewFactory::class;
    /** @var string */
    private $methodViewFactoryClass = MethodViewFactory::class;
    /** @var string */
    private $classViewFactoryClass = ClassViewFactory::class;

    /** @var string */
    private $phpDocViewClass = PhpDocView::class;
    /** @var string */
    private $propertyViewClass = PropertyView::class;
    /** @var string */
    private $usesViewClass = UsesView::class;
    /** @var string */
    private $useViewClass = UseView::class;
    /** @var string */
    private $traitsViewClass = TraitsView::class;
    /** @var string */
    private $methodsViewClass = MethodsView::class;
    /** @var string */
    private $propertiesViewClass = PropertiesView::class;
    /** @var string */
    private $methodParameterViewClass = MethodParameterView::class;
    /** @var string */
    private $methodViewClass = MethodView::class;
    /** @var string */
    private $classViewClass = ClassView::class;

    /** @var int */
    private $wrapOn;

    public function __construct(int $wrapOn = PhpDocViewInterface::DEFAULT_WRAP_ON)
    {
        $this->wrapOn = $wrapOn;
    }

    public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface
    {
        if (null === $this->phpDocViewFactory) {
            $this->phpDocViewFactory = new $this->phpDocViewFactoryClass(
                $this->phpDocViewClass,
                $this->wrapOn
            );
        }

        return $this->phpDocViewFactory;
    }

    public function buildPropertyViewFactory(): PropertyViewFactoryInterface
    {
        if (null === $this->propertyViewFactory) {
            $this->propertyViewFactory = new $this->propertyViewFactoryClass(
                $this->propertyViewClass,
                $this->buildPhpDocViewFactory()
            );
        }

        return $this->propertyViewFactory;
    }

    public function buildUsesViewFactory(): UsesViewFactoryInterface
    {
        if (null === $this->usesViewFactory) {
            $this->usesViewFactory = new $this->usesViewFactoryClass(
                $this->usesViewClass,
                $this->buildUseViewFactory()
            );
        }

        return $this->usesViewFactory;
    }

    public function buildUseViewFactory(): UseViewFactoryInterface
    {
        if (null === $this->useViewFactory) {
            $this->useViewFactory = new $this->useViewFactoryClass($this->useViewClass);
        }

        return $this->useViewFactory;
    }

    public function buildTraitsViewFactory(): TraitsViewFactoryInterface
    {
        if (null === $this->traitsViewFactory) {
            $this->traitsViewFactory = new $this->traitsViewFactoryClass($this->traitsViewClass);
        }

        return $this->traitsViewFactory;
    }

    public function buildMethodsViewFactory(): MethodsViewFactoryInterface
    {
        if (null === $this->methodsViewFactory) {
            $this->methodsViewFactory = new $this->methodsViewFactoryClass(
                $this->methodsViewClass,
                $this->buildMethodViewFactory()
            );
        }

        return $this->methodsViewFactory;
    }

    public function buildPropertiesViewFactory(): PropertiesViewFactoryInterface
    {
        if (null === $this->propertiesViewFactory) {
            $this->propertiesViewFactory = new $this->propertiesViewFactoryClass(
                $this->propertiesViewClass,
                $this->buildPropertyViewFactory()
            );
        }

        return $this->propertiesViewFactory;
    }

    public function buildMethodParameterViewFactory(): MethodParameterViewFactoryInterface
    {
        if (null === $this->methodParameterViewFactory) {
            $this->methodParameterViewFactory = new $this->methodParameterViewFactoryClass(
                $this->methodParameterViewClass
            );
        }

        return $this->methodParameterViewFactory;
    }

    public function buildMethodViewFactory(): MethodViewFactoryInterface
    {
        if (null === $this->methodViewFactory) {
            $this->methodViewFactory = new $this->methodViewFactoryClass(
                $this->methodViewClass,
                $this->buildPhpDocViewFactory(),
                $this->buildMethodParameterViewFactory()
            );
        }

        return $this->methodViewFactory;
    }

    public function buildClassViewFactory(): ClassViewFactoryInterface
    {
        if (null === $this->classViewFactory) {
            $this->classViewFactory = new $this->classViewFactoryClass(
                $this->classViewClass,
                $this->buildPhpDocViewFactory(),
                $this->buildMethodsViewFactory(),
                $this->buildUsesViewFactory(),
                $this->buildTraitsViewFactory(),
                $this->buildPropertiesViewFactory()
            );
        }

        return $this->classViewFactory;
    }

    public function getPhpDocViewFactoryClass(): string
    {
        return $this->phpDocViewFactoryClass;
    }

    public function setPhpDocViewFactoryClass(string $phpDocViewFactoryClass): void
    {
        $this->phpDocViewFactoryClass = $phpDocViewFactoryClass;
    }

    public function getPropertyViewFactoryClass(): string
    {
        return $this->propertyViewFactoryClass;
    }

    public function setPropertyViewFactoryClass(string $propertyViewFactoryClass): void
    {
        $this->propertyViewFactoryClass = $propertyViewFactoryClass;
    }

    public function getUsesViewFactoryClass(): string
    {
        return $this->usesViewFactoryClass;
    }

    public function setUsesViewFactoryClass(string $usesViewFactoryClass): void
    {
        $this->usesViewFactoryClass = $usesViewFactoryClass;
    }

    public function getUseViewFactoryClass(): string
    {
        return $this->useViewFactoryClass;
    }

    public function setUseViewFactoryClass(string $useViewFactoryClass): void
    {
        $this->useViewFactoryClass = $useViewFactoryClass;
    }

    public function getTraitsViewFactoryClass(): string
    {
        return $this->traitsViewFactoryClass;
    }

    public function setTraitsViewFactoryClass(string $traitsViewFactoryClass): void
    {
        $this->traitsViewFactoryClass = $traitsViewFactoryClass;
    }

    public function getMethodsViewFactoryClass(): string
    {
        return $this->methodsViewFactoryClass;
    }

    public function setMethodsViewFactoryClass(string $methodsViewFactoryClass): void
    {
        $this->methodsViewFactoryClass = $methodsViewFactoryClass;
    }

    public function getPropertiesViewFactoryClass(): string
    {
        return $this->propertiesViewFactoryClass;
    }

    public function setPropertiesViewFactoryClass(string $propertiesViewFactoryClass): void
    {
        $this->propertiesViewFactoryClass = $propertiesViewFactoryClass;
    }

    public function getMethodParameterViewFactoryClass(): string
    {
        return $this->methodParameterViewFactoryClass;
    }

    public function setMethodParameterViewFactoryClass(string $methodParameterViewFactoryClass): void
    {
        $this->methodParameterViewFactoryClass = $methodParameterViewFactoryClass;
    }

    public function getMethodViewFactoryClass(): string
    {
        return $this->methodViewFactoryClass;
    }

    public function setMethodViewFactoryClass(string $methodViewFactoryClass): void
    {
        $this->methodViewFactoryClass = $methodViewFactoryClass;
    }

    public function getClassViewFactoryClass(): string
    {
        return $this->classViewFactoryClass;
    }

    public function setClassViewFactoryClass(string $classViewFactoryClass): void
    {
        $this->classViewFactoryClass = $classViewFactoryClass;
    }

    public function getPhpDocViewClass(): string
    {
        return $this->phpDocViewClass;
    }

    public function setPhpDocViewClass(string $phpDocViewClass): void
    {
        $this->phpDocViewClass = $phpDocViewClass;
    }

    public function getPropertyViewClass(): string
    {
        return $this->propertyViewClass;
    }

    public function setPropertyViewClass(string $propertyViewClass): void
    {
        $this->propertyViewClass = $propertyViewClass;
    }

    public function getUsesViewClass(): string
    {
        return $this->usesViewClass;
    }

    public function setUsesViewClass(string $usesViewClass): void
    {
        $this->usesViewClass = $usesViewClass;
    }

    public function getUseViewClass(): string
    {
        return $this->useViewClass;
    }

    public function setUseViewClass(string $useViewClass): void
    {
        $this->useViewClass = $useViewClass;
    }
    public function getTraitsViewClass(): string
    {
        return $this->traitsViewClass;
    }

    public function setTraitsViewClass(string $traitsViewClass): void
    {
        $this->traitsViewClass = $traitsViewClass;
    }

    public function getMethodsViewClass(): string
    {
        return $this->methodsViewClass;
    }

    public function setMethodsViewClass(string $methodsViewClass): void
    {
        $this->methodsViewClass = $methodsViewClass;
    }

    public function getPropertiesViewClass(): string
    {
        return $this->propertiesViewClass;
    }

    public function setPropertiesViewClass(string $propertiesViewClass): void
    {
        $this->propertiesViewClass = $propertiesViewClass;
    }

    public function getMethodParameterViewClass(): string
    {
        return $this->methodParameterViewClass;
    }

    public function setMethodParameterViewClass(string $methodParameterViewClass): void
    {
        $this->methodParameterViewClass = $methodParameterViewClass;
    }

    public function getMethodViewClass(): string
    {
        return $this->methodViewClass;
    }

    public function setMethodViewClass(string $methodViewClass): void
    {
        $this->methodViewClass = $methodViewClass;
    }

    public function getClassViewClass(): string
    {
        return $this->classViewClass;
    }

    public function setClassViewClass(string $classViewClass): void
    {
        $this->classViewClass = $classViewClass;
    }

    public function getWrapOn(): int
    {
        return $this->wrapOn;
    }

    public function setWrapOn(int $wrapOn): void
    {
        $this->wrapOn = $wrapOn;
    }
}
