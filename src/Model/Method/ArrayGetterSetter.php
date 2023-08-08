<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use LogicException;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

class ArrayGetterSetter extends GetterSetter implements ArrayGetterSetterInterface
{
    public function __construct(
        UsesInterface $uses,
        MethodInterface $getterMethod,
        MethodInterface $setterMethod,
        protected MethodInterface $hasGetterMethod,
        protected MethodInterface $addSetterMethod,
        protected MethodInterface $removeSetterMethod,
        MethodParameterModelFactoryInterface $methodParameterFactory
    ) {
        parent::__construct(
            $uses,
            $getterMethod,
            $setterMethod,
            $methodParameterFactory
        );
    }

    public function supports(PropertyInterface $propertyGenerator): bool
    {
        $type = $propertyGenerator->getPhpTypeFromTypes();

        if ($type === 'array') {
            return true;
        }

        if ($type === '?array') {
            return true;
        }

        return false;
    }

    public function getMethods(): array
    {
        $methods = parent::getMethods();
        if (null === $this->property) {
            throw new LogicException('You must first call "buildGetterSetter" method.');
        }

        if (false === $this->property->isWriteable()) {
            return $methods;
        }

        return array_merge(
            $methods,
            [
                $this->hasGetterMethod,
                $this->addSetterMethod,
                $this->removeSetterMethod,
            ]
        );
    }

    protected function configureSetter(): void
    {
        parent::configureSetter();

        $this->configureHasGetter();
        $this->configureAddSetter();
        $this->configureRemoveSetter();
    }

    protected function configureHasGetter(): void
    {
        if (null === $this->property) {
            return;
        }

        if (false === $this->property->isWriteable()) {
            return;
        }

        $this->hasGetterMethod->configure(
            MethodInterface::SCOPE_PUBLIC,
            $this->getSingleMethodName(static::HAS_GETTER_PREFIX),
            ['bool']
        );

        $methodParameter = $this->methodParameterFactory->create($this->uses);
        $methodParameter->configure(
            $this->getSingleTypes(),
            $this->getSingleName()
        );
        $this->hasGetterMethod->addParameter($methodParameter);

        $format = '';
        if (in_array('null', $this->property->getTypes(), true)) {
            $format .= 'if (null === $this->%2$s) {' . "\n";
            $format .= '%3$sreturn false;' . "\n";
            $format .= '}' . "\n\n";
        }

        $format .= 'return in_array($%1$s, $this->%2$s, true);';

        $this->hasGetterMethod->addMultipleLines(
            sprintf(
                $format,
                $this->getSingleName(),
                $this->property->getName(),
                $this->hasGetterMethod->getLineIndentation()
            )
        );
    }

    protected function configureAddSetter(): void
    {
        if (null === $this->property) {
            return;
        }

        if (false === $this->property->isWriteable()) {
            return;
        }

        $this->addSetterMethod->configure(
            MethodInterface::SCOPE_PUBLIC,
            $this->getSingleMethodName(static::ADD_SETTER_PREFIX),
            ['void']
        );

        $methodParameter = $this->methodParameterFactory->create($this->uses);
        $methodParameter->configure(
            $this->getSingleTypes(),
            $this->getSingleName()
        );
        $this->addSetterMethod->addParameter($methodParameter);

        $format = 'if ($this->%1$s(%2$s)) {' . "\n";
        $format .= '%3$sreturn;' . "\n";
        $format .= '}' . "\n\n";

        if (in_array('null', $this->property->getTypes())) {
            $format .= 'if (null === $this->%4$s) {' . "\n";
            $format .= '%3$s$this->%4$s = [];' . "\n";
            $format .= '}' . "\n\n";
        }

        $format .= '$this->%4$s[] = %2$s;';

        $this->addSetterMethod->addMultipleLines(
            sprintf(
                $format,
                $this->getSingleMethodName(static::HAS_GETTER_PREFIX),
                $methodParameter->getPhpName(),
                $this->addSetterMethod->getLineIndentation(),
                $this->property->getName()
            )
        );
    }

    protected function configureRemoveSetter(): void
    {
        if (null === $this->property) {
            return;
        }

        if (false === $this->property->isWriteable()) {
            return;
        }

        $this->removeSetterMethod->configure(
            MethodInterface::SCOPE_PUBLIC,
            $this->getSingleMethodName(static::REMOVE_SETTER_PREFIX),
            ['void']
        );
        $methodParameter = $this->methodParameterFactory->create($this->uses);
        $methodParameter->configure(
            $this->getSingleTypes(),
            $this->getSingleName()
        );

        $this->removeSetterMethod->addParameter($methodParameter);

        $format = '';
        if (in_array('null', $this->property->getTypes())) {
            $format .= 'if (null === $this->%4$s) {' . "\n";
            $format .= '%3$s$this->%4$s = [];' . "\n";
            $format .= '}' . "\n\n";
        }

        $format .= 'if ($this->%1$s(%2$s)) {' . "\n";
        $format .= '%3$s$index = array_search(%2$s, $this->%4$s, true);' . "\n";
        $format .= '%3$sunset($this->%4$s[$index]);' . "\n";
        $format .= '}';

        $this->removeSetterMethod->addMultipleLines(
            sprintf(
                $format,
                $this->getSingleMethodName(static::HAS_GETTER_PREFIX),
                $methodParameter->getPhpName(),
                $this->removeSetterMethod->getLineIndentation(),
                $this->property->getName()
            )
        );
    }

    protected function getSingleMethodName(?string $prefix = null, ?string $suffix = null): string
    {
        return $this->getMethodName($prefix, $suffix);
    }

    public function getSingleTypes(): array
    {
        $phpSingleTypes = [];

        if (null === $this->property) {
            return $phpSingleTypes;
        }

        foreach ($this->property->getTypes() as $type) {
            if (str_ends_with($type, '[]')) {
                $phpSingleTypes[] = rtrim($type, '[]');
            }

            if ($type === 'array') {
                $phpSingleTypes[] = 'mixed';
            }
        }

        return $phpSingleTypes;
    }

    public function getSingleName(): string
    {
        return 'item';
    }

    public function getHasGetterMethod(): MethodInterface
    {
        return $this->hasGetterMethod;
    }

    public function setHasGetterMethod(MethodInterface $hasGetterMethod): void
    {
        $this->hasGetterMethod = $hasGetterMethod;
    }

    public function getAddSetterMethod(): MethodInterface
    {
        return $this->addSetterMethod;
    }

    public function setAddSetterMethod(MethodInterface $addSetterMethod): void
    {
        $this->addSetterMethod = $addSetterMethod;
    }

    public function getRemoveSetterMethod(): MethodInterface
    {
        return $this->removeSetterMethod;
    }

    public function setRemoveSetterMethod(MethodInterface $removeSetterMethod): void
    {
        $this->removeSetterMethod = $removeSetterMethod;
    }
}
