<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\PhpDoc;

use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewInterface;

interface PhpDocViewFactoryInterface
{
    public function create(PhpDocInterface $phpDoc): PhpDocViewInterface;

    public function setPhpDocViewClass(string $phpDocViewClass): void;

    public function getPhpDocViewClass(): string;

    public function getWrapOn(): int;

    public function setWrapOn(int $wrapOn): void;
}
