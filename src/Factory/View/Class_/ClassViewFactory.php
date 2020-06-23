<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Class_;

use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\View\Class_\ClassViewInterface;

final class ClassViewFactory implements ClassViewFactoryInterface
{
    /** @var string */
    protected $classViewClass;
    /** @var PhpDocViewFactoryInterface */
    protected $phpDocViewFactory;
    /** @var MethodsViewFactoryInterface */
    protected $methodsViewFactory;
    /** @var UsesViewFactoryInterface */
    protected $usesViewFactory;
    /** @var TraitsViewFactoryInterface */
    protected $traitsViewFactory;
    /** @var PropertiesViewFactoryInterface */
    protected $propertiesViewFactory;

    public function __construct(
        string $classViewClass,
        PhpDocViewFactoryInterface $phpDocViewFactory,
        MethodsViewFactoryInterface $methodsViewFactory,
        UsesViewFactoryInterface $usesViewFactory,
        TraitsViewFactoryInterface $traitsViewFactory,
        PropertiesViewFactoryInterface $propertiesViewFactory
    ) {
        $this->classViewClass = $classViewClass;
        $this->phpDocViewFactory = $phpDocViewFactory;
        $this->methodsViewFactory = $methodsViewFactory;
        $this->usesViewFactory = $usesViewFactory;
        $this->traitsViewFactory = $traitsViewFactory;
        $this->propertiesViewFactory = $propertiesViewFactory;
    }

    public function create(ClassInterface $classModel): ClassViewInterface
    {
        return new $this->classViewClass(
            $classModel,
            $this->phpDocViewFactory,
            $this->usesViewFactory,
            $this->traitsViewFactory,
            $this->propertiesViewFactory,
            $this->methodsViewFactory,
        );
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
