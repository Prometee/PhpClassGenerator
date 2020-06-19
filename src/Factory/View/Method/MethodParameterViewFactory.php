<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Method;

use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\View\Method\MethodParameterViewInterface;

final class MethodParameterViewFactory implements MethodParameterViewFactoryInterface
{
    /** @var string */
    protected $methodViewClass;

    public function __construct(string $methodViewClass)
    {
        $this->methodViewClass = $methodViewClass;
    }

    public function create(MethodParameterInterface $method): MethodParameterViewInterface
    {
        return new $this->methodViewClass($method);
    }
}
