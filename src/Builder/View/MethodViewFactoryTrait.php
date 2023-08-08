<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Method\MethodParameterView;
use Prometee\PhpClassGenerator\View\Method\MethodParameterViewInterface;
use Prometee\PhpClassGenerator\View\Method\MethodView;
use Prometee\PhpClassGenerator\View\Method\MethodViewInterface;

trait MethodViewFactoryTrait
{
    private ?MethodParameterViewFactoryInterface $methodParameterViewFactory = null;
    private ?MethodViewFactoryInterface $methodViewFactory = null;

    /** @var class-string<MethodParameterViewFactoryInterface> */
    private string $methodParameterViewFactoryClass = MethodParameterViewFactory::class;
    /** @var class-string<MethodViewFactoryInterface> */
    private string $methodViewFactoryClass = MethodViewFactory::class;

    /** @var class-string<MethodParameterViewInterface> */
    private string $methodParameterViewClass = MethodParameterView::class;
    /** @var class-string<MethodViewInterface> */
    private string $methodViewClass = MethodView::class;

    abstract public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface;

    public function buildMethodParameterViewFactory(): MethodParameterViewFactoryInterface
    {
        if (null === $this->methodParameterViewFactory) {
            $this->methodParameterViewFactory = new $this->methodParameterViewFactoryClass(
                $this->methodParameterViewClass,
                $this->buildPhpDocViewFactory()
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
}
