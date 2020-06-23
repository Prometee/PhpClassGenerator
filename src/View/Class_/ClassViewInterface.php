<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Class_;

use Prometee\PhpClassGenerator\View\ViewInterface;

interface ClassViewInterface extends ViewInterface
{
    public function buildBody(): string;

    public function buildSignature(): ?string;

    public function buildExtends(): ?string;

    public function buildImplements(): ?string;
}
