<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Class_;

use Prometee\PhpClassGenerator\View\Attribute\AttributeViewAwareInterface;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewAwareInterface;
use Prometee\PhpClassGenerator\View\ViewInterface;

interface ClassViewInterface extends ViewInterface, PhpDocViewAwareInterface, AttributeViewAwareInterface
{
    public function buildBody(): string;

    public function buildSignature(): ?string;

    public function buildExtends(): ?string;

    public function buildImplements(): ?string;
}
