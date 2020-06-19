<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Method;

use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\View\Method\MethodViewInterface;

interface MethodViewFactoryInterface
{
    public function create(MethodInterface $method): MethodViewInterface;
}
