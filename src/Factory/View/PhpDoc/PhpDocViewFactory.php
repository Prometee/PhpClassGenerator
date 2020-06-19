<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\PhpDoc;

use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewInterface;

final class PhpDocViewFactory implements PhpDocViewFactoryInterface
{
    /** @var string */
    private $phpDocViewClass;
    /** @var int */
    private $wrapOn;

    public function __construct(
        string $phpDocViewClass,
        int $wrapOn = PhpDocViewInterface::DEFAULT_WRAP_ON
    ) {
        $this->phpDocViewClass = $phpDocViewClass;
        $this->wrapOn = $wrapOn;
    }

    public function create(PhpDocInterface $phpDoc): PhpDocViewInterface
    {
        return new $this->phpDocViewClass(
            $phpDoc,
            $this->wrapOn
        );
    }

    public function setPhpDocViewClass(string $phpDocViewClass): void
    {
        $this->phpDocViewClass = $phpDocViewClass;
    }

    public function getPhpDocViewClass(): string
    {
        return $this->phpDocViewClass;
    }

    public function getWrapOn(): int
    {
        return $this->wrapOn;
    }

    public function setWrapOn(int $wrapOn): void
    {
        $this->wrapOn = $wrapOn;
    }
}
