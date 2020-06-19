<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Method;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\View\Method\MethodViewInterface;

final class MethodViewFactory implements MethodViewFactoryInterface
{
    /** @var string */
    protected $methodViewClass;
    /** @var PhpDocViewFactoryInterface */
    protected $phpDocViewFactory;
    /** @var MethodParameterViewFactory */
    protected $methodParameterViewFactory;

    public function __construct(
        string $methodViewClass,
        PhpDocViewFactoryInterface $phpDocViewFactory,
        MethodParameterViewFactory $methodParameterViewFactory
    ) {
        $this->methodViewClass = $methodViewClass;
        $this->phpDocViewFactory = $phpDocViewFactory;
        $this->methodParameterViewFactory = $methodParameterViewFactory;
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
