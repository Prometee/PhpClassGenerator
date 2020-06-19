<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Method;

use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\View\Method\MethodParameterViewInterface;

interface MethodParameterViewFactoryInterface
{
    public function create(MethodParameterInterface $method): MethodParameterViewInterface;
}
