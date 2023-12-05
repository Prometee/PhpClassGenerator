<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Method;

use Prometee\PhpClassGenerator\View\Attribute\AttributeViewAwareInterface;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewAwareInterface;
use Prometee\PhpClassGenerator\View\ViewInterface;

interface MethodParameterViewInterface extends ViewInterface, PhpDocViewAwareInterface, AttributeViewAwareInterface
{
}
