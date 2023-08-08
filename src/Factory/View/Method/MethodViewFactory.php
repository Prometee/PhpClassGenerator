<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Method;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\View\Method\MethodViewInterface;

final class MethodViewFactory implements MethodViewFactoryInterface
{
    public function __construct(
        /** @var class-string<MethodViewInterface> */
        protected string $methodViewClass,
        protected PhpDocViewFactoryInterface $phpDocViewFactory,
        protected MethodParameterViewFactory $methodParameterViewFactory
    ) {
    }

    public function create(MethodInterface $method): MethodViewInterface
    {
        return new $this->methodViewClass(
            $method,
            $this->phpDocViewFactory,
            $this->methodParameterViewFactory
        );
    }
}
