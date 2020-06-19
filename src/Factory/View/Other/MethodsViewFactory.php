<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\View\Other\MethodsViewInterface;

final class MethodsViewFactory implements MethodsViewFactoryInterface
{
    /** @var string */
    protected $methodsViewClass;
    /** @var MethodViewFactoryInterface */
    protected $methodViewFactory;

    public function __construct(
        string $methodsViewClass,
        MethodViewFactoryInterface $methodViewFactory
    ) {
        $this->methodsViewClass = $methodsViewClass;
        $this->methodViewFactory = $methodViewFactory;
    }

    public function create(MethodsInterface $methods): MethodsViewInterface
    {
        return new $this->methodsViewClass(
            $methods,
            $this->methodViewFactory
        );
    }
}
