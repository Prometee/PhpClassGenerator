<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Method;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\View\Method\MethodParameterViewInterface;

final class MethodParameterViewFactory implements MethodParameterViewFactoryInterface
{
    public function __construct(
        /** @var class-string<MethodParameterViewInterface> */
        protected string $methodViewClass,
        protected PhpDocViewFactoryInterface $phpDocViewFactory,
    ) {
    }

    public function create(MethodParameterInterface $method): MethodParameterViewInterface
    {
        return new $this->methodViewClass($method, $this->phpDocViewFactory);
    }
}
