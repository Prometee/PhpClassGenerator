<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Method;

use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewAwareInterface;
use Prometee\PhpClassGenerator\View\ViewInterface;

interface MethodViewInterface extends ViewInterface, PhpDocViewAwareInterface
{
    public function buildMethodBody(): string;

    public function buildMethodSignature(int $wrapOn): string;

    public function buildMethodParameters(string $formatVar = ' '): string;

    public function buildReturnType(): string;
}
