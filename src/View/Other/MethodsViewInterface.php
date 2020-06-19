<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Model\Method\MethodInterface;

interface MethodsViewInterface extends ArrayViewInterface
{
    /**
     * @return MethodInterface[]
     */
    public function orderMethods(): array;
}
