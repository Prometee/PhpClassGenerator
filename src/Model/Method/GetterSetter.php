<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareTrait;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use function Symfony\Component\String\u;

class GetterSetter implements GetterSetterInterface
{
    use UsesAwareTrait {
        UsesAwareTrait::__construct as private __constructUses;
    }

    /** @var MethodInterface */
    protected $getterMethod;
    /** @var MethodInterface */
    protected $setterMethod;
    /** @var MethodParameterModelFactoryInterface */
    protected $methodParameterFactory;

    /** @var PropertyInterface */
    protected $property;

    public function __construct(
        UsesInterface $uses,
        MethodInterface $getterMethod,
        MethodInterface $setterModelMethod,
        MethodParameterModelFactoryInterface $methodParameterFactory
    ) {
        $this->__constructUses($uses);
        $this->getterMethod = $getterMethod;
        $this->setterMethod = $setterModelMethod;
        $this->methodParameterFactory = $methodParameterFactory;

        $this->getterMethod->setUses($this->uses);
        $this->setterMethod->setUses($this->uses);
    }

    public function supports(PropertyInterface $propertyGenerator): bool
    {
        return true;
    }

    public function configure(PropertyInterface $propertyGenerator): void
    {
        $this->property = $propertyGenerator;

        $this->configureGetter();
        $this->configureSetter();
    }

    public function getMethods(): array
    {
        $methods = [];
        if ($this->property->isReadable()) {
            $methods[] = $this->getterMethod;
        }
        if ($this->property->isWriteable()) {
            $methods[] = $this->setterMethod;
        }

        return $methods;
    }

    public function getMethodName(?string $prefix = null, ?string $suffix = null): string
    {
        $name = u($this->property->getName())
            ->camel()->title()
            ->toString();

        return $prefix . $name . $suffix;
    }

    public function configureGetter(): void
    {
        if (false === $this->property->isReadable()) {
            return;
        }

        $this->getterMethod->configure(
            MethodInterface::SCOPE_PUBLIC,
            $this->getMethodName(static::GETTER_PREFIX),
            $this->property->getTypes()
        );

        $this->getterMethod->addLine(
            sprintf('return $this->%s;', $this->property->getName())
        );
    }

    public function configureSetter(): void
    {
        if (false === $this->property->isWriteable()) {
            return;
        }

        $this->setterMethod->configure(
            MethodInterface::SCOPE_PUBLIC,
            $this->getMethodName(static::SETTER_PREFIX),
            ['void']
        );
        $methodParameter = $this->methodParameterFactory->create($this->uses);
        $methodParameter->configure(
            $this->property->getTypes(),
            $this->property->getName()
        );

        $this->setterMethod->addParameter($methodParameter);

        $this->setterMethod->addLine(
            sprintf('$this->%s = %s;', $this->property->getName(), $methodParameter->getPhpName())
        );
    }

    public function getGetterMethod(): MethodInterface
    {
        return $this->getterMethod;
    }

    public function setGetterMethod(MethodInterface $getterMethod): void
    {
        $this->getterMethod = $getterMethod;
    }

    public function getSetterMethod(): MethodInterface
    {
        return $this->setterMethod;
    }

    public function setSetterMethod(MethodInterface $setterMethod): void
    {
        $this->setterMethod = $setterMethod;
    }
}
