<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\ClassView;

use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\ClassModel\ClassModelInterface;
use Prometee\PhpClassGenerator\View\ClassView\ClassViewInterface;

final class ClassViewFactory implements ClassViewFactoryInterface
{
    /** @var string */
    protected $classViewClass;
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
        MethodsViewFactoryInterface $methodsViewFactory,
        UsesViewFactoryInterface $usesViewFactory,
        TraitsViewFactoryInterface $traitsViewFactory,
        PropertiesViewFactoryInterface $propertiesViewFactory
    ) {
        $this->classViewClass = $classViewClass;
        $this->methodsViewFactory = $methodsViewFactory;
        $this->usesViewFactory = $usesViewFactory;
        $this->traitsViewFactory = $traitsViewFactory;
        $this->propertiesViewFactory = $propertiesViewFactory;
    }

    public function create(ClassModelInterface $classModel): ClassViewInterface
    {
        return new $this->classViewClass(
            $classModel,
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
