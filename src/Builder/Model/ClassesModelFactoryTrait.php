<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Class_\AbstractClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\AbstractClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\FinalClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\FinalClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\InterfaceClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\InterfaceClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\TraitClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\TraitClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\AbstractClass;
use Prometee\PhpClassGenerator\Model\Class_\AbstractClassInterface;
use Prometee\PhpClassGenerator\Model\Class_\FinalClass;
use Prometee\PhpClassGenerator\Model\Class_\FinalClassInterface;
use Prometee\PhpClassGenerator\Model\Class_\InterfaceClass;
use Prometee\PhpClassGenerator\Model\Class_\InterfaceClassInterface;
use Prometee\PhpClassGenerator\Model\Class_\TraitClass;
use Prometee\PhpClassGenerator\Model\Class_\TraitClassInterface;

trait ClassesModelFactoryTrait
{
    use ClassModelFactoryTrait;

    private ?FinalClassModelFactoryInterface $finalClassModelFactory = null;
    private ?TraitClassModelFactoryInterface $traitClassModelFactory = null;
    private ?AbstractClassModelFactoryInterface $abstractClassModelFactory = null;
    private ?InterfaceClassModelFactoryInterface $interfaceClassModelFactory = null;

    /** @var class-string<FinalClassModelFactoryInterface> */
    private string $finalClassModelFactoryClass = FinalClassModelFactory::class;
    /** @var class-string<TraitClassModelFactoryInterface> */
    private string $traitClassModelFactoryClass = TraitClassModelFactory::class;
    /** @var class-string<AbstractClassModelFactoryInterface> */
    private string $abstractClassModelFactoryClass = AbstractClassModelFactory::class;
    /** @var class-string<InterfaceClassModelFactoryInterface> */
    private string $interfaceClassModelFactoryClass = InterfaceClassModelFactory::class;

    /** @var class-string<FinalClassInterface> */
    private string $finalClassClass = FinalClass::class;
    /** @var class-string<TraitClassInterface> */
    private string $traitClassClass = TraitClass::class;
    /** @var class-string<AbstractClassInterface> */
    private string $abstractClassClass = AbstractClass::class;
    /** @var class-string<InterfaceClassInterface> */
    private string $interfaceClassClass = InterfaceClass::class;

    public function buildFinalClassModelFactory(): FinalClassModelFactoryInterface
    {
        if (null === $this->finalClassModelFactory) {
            $this->finalClassModelFactory = new $this->finalClassModelFactoryClass(
                $this->finalClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->finalClassModelFactory;
    }

    public function buildTraitClassModelFactory(): TraitClassModelFactoryInterface
    {
        if (null === $this->traitClassModelFactory) {
            $this->traitClassModelFactory = new $this->traitClassModelFactoryClass(
                $this->traitClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->traitClassModelFactory;
    }

    public function buildAbstractClassModelFactory(): AbstractClassModelFactoryInterface
    {
        if (null === $this->abstractClassModelFactory) {
            $this->abstractClassModelFactory = new $this->abstractClassModelFactoryClass(
                $this->abstractClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->abstractClassModelFactory;
    }

    public function buildInterfaceClassModelFactory(): InterfaceClassModelFactoryInterface
    {
        if (null === $this->interfaceClassModelFactory) {
            $this->interfaceClassModelFactory = new $this->interfaceClassModelFactoryClass(
                $this->interfaceClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->interfaceClassModelFactory;
    }

    public function getFinalClassModelFactoryClass(): string
    {
        return $this->finalClassModelFactoryClass;
    }

    public function setFinalClassModelFactoryClass(string $finalClassModelFactoryClass): void
    {
        $this->finalClassModelFactoryClass = $finalClassModelFactoryClass;
    }

    public function getTraitClassModelFactoryClass(): string
    {
        return $this->traitClassModelFactoryClass;
    }

    public function setTraitClassModelFactoryClass(string $traitClassModelFactoryClass): void
    {
        $this->traitClassModelFactoryClass = $traitClassModelFactoryClass;
    }

    public function getAbstractClassModelFactoryClass(): string
    {
        return $this->abstractClassModelFactoryClass;
    }

    public function setAbstractClassModelFactoryClass(string $abstractClassModelFactoryClass): void
    {
        $this->abstractClassModelFactoryClass = $abstractClassModelFactoryClass;
    }

    public function getInterfaceClassModelFactoryClass(): string
    {
        return $this->interfaceClassModelFactoryClass;
    }

    public function setInterfaceClassModelFactoryClass(string $interfaceClassModelFactoryClass): void
    {
        $this->interfaceClassModelFactoryClass = $interfaceClassModelFactoryClass;
    }

    public function getFinalClassClass(): string
    {
        return $this->finalClassClass;
    }

    public function setFinalClassClass(string $finalClassClass): void
    {
        $this->finalClassClass = $finalClassClass;
    }

    public function getTraitClassClass(): string
    {
        return $this->traitClassClass;
    }

    public function setTraitClassClass(string $traitClassClass): void
    {
        $this->traitClassClass = $traitClassClass;
    }

    public function getAbstractClassClass(): string
    {
        return $this->abstractClassClass;
    }

    public function setAbstractClassClass(string $abstractClassClass): void
    {
        $this->abstractClassClass = $abstractClassClass;
    }

    public function getInterfaceClassClass(): string
    {
        return $this->interfaceClassClass;
    }

    public function setInterfaceClassClass(string $interfaceClassClass): void
    {
        $this->interfaceClassClass = $interfaceClassClass;
    }
}
