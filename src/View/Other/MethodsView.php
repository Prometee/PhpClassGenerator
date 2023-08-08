<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;

class MethodsView extends AbstractArrayView implements MethodsViewInterface
{
    public function __construct(
        protected MethodsInterface $methods,
        protected MethodViewFactoryInterface $methodViewFactory
    ) {
    }

    public function getArrayToBuild(): array
    {
        $methods = $this->orderMethods();

        $views = [];
        foreach ($methods as $method) {
            $views[] = $this->methodViewFactory->create($method);
        }

        return $views;
    }

    public function orderMethods(): array
    {
        $methods = $this->methods->getMethods();
        uksort($methods, function ($k1, $k2) {
            $o1 = preg_match('#^__#', $k1) === 0 ? 1 : 0;
            $o2 = preg_match('#^__#', $k2) === 0 ? 1 : 0;

            return $o1 - $o2;
        });

        return $methods;
    }
}
