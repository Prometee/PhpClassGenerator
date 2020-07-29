<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

interface PhpDocViewAwareInterface
{
    public function getPhpDocViewFactory(): PhpDocViewFactoryInterface;

    public function setPhpDocViewFactory(PhpDocViewFactoryInterface $phpDocViewFactory): void;

    public function configurePhpDoc(PhpDocInterface $phpDoc, UsesInterface $uses): void;
}
