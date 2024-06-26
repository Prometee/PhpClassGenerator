<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

interface PhpDocViewAwareInterface
{
    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void;
}
