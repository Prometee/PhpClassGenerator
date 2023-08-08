<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\View\Other\MethodsViewInterface;

final class MethodsViewFactory implements MethodsViewFactoryInterface
{
    public function __construct(
        /** @var class-string<MethodsViewInterface> */
        protected string $methodsViewClass,
        protected MethodViewFactoryInterface $methodViewFactory,
    ) {
    }

    public function create(MethodsInterface $methods): MethodsViewInterface
    {
        return new $this->methodsViewClass(
            $methods,
            $this->methodViewFactory
        );
    }
}
