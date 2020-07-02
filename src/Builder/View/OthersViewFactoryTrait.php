<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

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
use Prometee\PhpClassGenerator\Factory\View\Property\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Other\MethodsView;
use Prometee\PhpClassGenerator\View\Other\PropertiesView;
use Prometee\PhpClassGenerator\View\Other\TraitsView;
use Prometee\PhpClassGenerator\View\Other\UsesView;
use Prometee\PhpClassGenerator\View\Other\UseView;

trait OthersViewFactoryTrait
{
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
    private $usesViewClass = UsesView::class;
    /** @var string */
    private $useViewClass = UseView::class;
    /** @var string */
    private $traitsViewClass = TraitsView::class;
    /** @var string */
    private $methodsViewClass = MethodsView::class;
    /** @var string */
    private $propertiesViewClass = PropertiesView::class;

    abstract public function buildMethodViewFactory(): MethodViewFactoryInterface;
    abstract public function buildPropertyViewFactory(): PropertyViewFactoryInterface;

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
}
