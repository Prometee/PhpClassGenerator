<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Class_\ClassView;

trait ClassViewFactoryTrait
{
    /** @var ClassViewFactoryInterface */
    private $classViewFactory;

    /** @var string */
    private $classViewFactoryClass = ClassViewFactory::class;

    /** @var string */
    private $classViewClass = ClassView::class;

    abstract public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface;
    abstract public function buildMethodsViewFactory(): MethodsViewFactoryInterface;
    abstract public function buildUsesViewFactory(): UsesViewFactoryInterface;
    abstract public function buildTraitsViewFactory(): TraitsViewFactoryInterface;
    abstract public function buildPropertiesViewFactory(): PropertiesViewFactoryInterface;

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

    public function getClassViewFactoryClass(): string
    {
        return $this->classViewFactoryClass;
    }

    public function setClassViewFactoryClass(string $classViewFactoryClass): void
    {
        $this->classViewFactoryClass = $classViewFactoryClass;
    }

    public function getClassViewClass(): string
    {
        return $this->classViewClass;
    }

    public function setClassViewClass(string $classViewClass): void
    {
        $this->classViewClass = $classViewClass;
    }
}
