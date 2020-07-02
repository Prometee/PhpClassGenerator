<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Property;

use Prometee\PhpClassGenerator\View\ViewInterface;

interface PropertyViewInterface extends ViewInterface
{
    public function configurePhpDoc(): void;
}
