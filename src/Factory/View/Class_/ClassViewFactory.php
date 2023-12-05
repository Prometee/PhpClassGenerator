<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Class_;

use Prometee\PhpClassGenerator\Factory\View\Attribute\AttributeViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\View\Class_\ClassViewInterface;

final class ClassViewFactory implements ClassViewFactoryInterface
{
    public function __construct(
        /** @var class-string<ClassViewInterface> */
        protected string $classViewClass,
        protected PhpDocViewFactoryInterface $phpDocViewFactory,
        protected MethodsViewFactoryInterface $methodsViewFactory,
        protected UsesViewFactoryInterface $usesViewFactory,
        protected TraitsViewFactoryInterface $traitsViewFactory,
        protected PropertiesViewFactoryInterface $propertiesViewFactory,
        protected AttributeViewFactoryInterface $attributeViewFactory,
    ) {
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
            $this->attributeViewFactory,
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
