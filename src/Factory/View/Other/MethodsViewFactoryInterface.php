<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\View\Other\MethodsViewInterface;

interface MethodsViewFactoryInterface
{
    public function create(MethodsInterface $methods): MethodsViewInterface;
}
