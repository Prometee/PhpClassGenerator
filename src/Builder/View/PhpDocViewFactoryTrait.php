<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactory;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocView;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewInterface;

trait PhpDocViewFactoryTrait
{
    private ?PhpDocViewFactoryInterface $phpDocViewFactory = null;

    /** @var class-string<PhpDocViewFactoryInterface> */
    private string $phpDocViewFactoryClass = PhpDocViewFactory::class;

    /** @var class-string<PhpDocViewInterface> */
    private string $phpDocViewClass = PhpDocView::class;

    private int $wrapOn;

    public function __construct(int $wrapOn = PhpDocViewInterface::DEFAULT_WRAP_ON)
    {
        $this->wrapOn = $wrapOn;
    }

    public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface
    {
        if (null === $this->phpDocViewFactory) {
            $this->phpDocViewFactory = new $this->phpDocViewFactoryClass(
                $this->phpDocViewClass,
                $this->wrapOn
            );
        }

        return $this->phpDocViewFactory;
    }

    public function getPhpDocViewFactoryClass(): string
    {
        return $this->phpDocViewFactoryClass;
    }

    public function setPhpDocViewFactoryClass(string $phpDocViewFactoryClass): void
    {
        $this->phpDocViewFactoryClass = $phpDocViewFactoryClass;
    }

    public function getPhpDocViewClass(): string
    {
        return $this->phpDocViewClass;
    }

    public function setPhpDocViewClass(string $phpDocViewClass): void
    {
        $this->phpDocViewClass = $phpDocViewClass;
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
