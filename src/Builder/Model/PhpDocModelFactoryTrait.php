<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDoc;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

trait PhpDocModelFactoryTrait
{
    private ?PhpDocModelFactoryInterface $phpDocModelFactory = null;

    /** @var class-string<PhpDocModelFactoryInterface> */
    private string $phpDocModelFactoryClass = PhpDocModelFactory::class;

    /** @var class-string<PhpDocInterface> */
    private string $phpDocClass = PhpDoc::class;

    public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        if (null === $this->phpDocModelFactory) {
            $this->phpDocModelFactory = new $this->phpDocModelFactoryClass(
                $this->phpDocClass
            );
        }

        return $this->phpDocModelFactory;
    }

    public function getPhpDocModelFactoryClass(): string
    {
        return $this->phpDocModelFactoryClass;
    }

    public function setPhpDocModelFactoryClass(string $phpDocModelFactoryClass): void
    {
        $this->phpDocModelFactoryClass = $phpDocModelFactoryClass;
    }

    public function getPhpDocClass(): string
    {
        return $this->phpDocClass;
    }

    public function setPhpDocClass(string $phpDocClass): void
    {
        $this->phpDocClass = $phpDocClass;
    }
}
