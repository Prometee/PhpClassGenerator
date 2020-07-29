<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

class ArrayGetterSetter extends GetterSetter implements ArrayGetterSetterInterface
{
    /** @var MethodInterface */
    protected $hasGetterMethod;
    /** @var MethodInterface */
    protected $addSetterMethod;
    /** @var MethodInterface */
    protected $removeSetterMethod;

    public function __construct(
        UsesInterface $uses,
        MethodInterface $getterMethod,
        MethodInterface $setterMethod,
        MethodInterface $hasGetterMethod,
        MethodInterface $addSetterMethod,
        MethodInterface $removeSetterMethod,
        MethodParameterModelFactoryInterface $methodParameterFactory
    ) {
        parent::__construct(
            $uses,
            $getterMethod,
            $setterMethod,
            $methodParameterFactory
        );

        $this->hasGetterMethod = $hasGetterMethod;
        $this->addSetterMethod = $addSetterMethod;
        $this->removeSetterMethod = $removeSetterMethod;
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

    public function configureSetter(): void
    {
        parent::configureSetter();

        $this->configureHasGetter();
        $this->configureAddSetter();
        $this->configureRemoveSetter();
    }

    public function configureHasGetter(): void
    {
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
        if (in_array('null', $this->property->getTypes())) {
            $format .= 'if (null === $this->%2$s) {' . "\n";
            $format .= '%3$sreturn false;' . "\n";
            $format .= '}' . "\n\n";
        }

        $format .= 'return in_array($%1$s, $this->%2$s);';

        $this->hasGetterMethod->addMultipleLines(
            sprintf(
                $format,
                $this->getSingleName(),
                $this->property->getName(),
                $this->hasGetterMethod->getLineIndentation()
            )
        );
    }

    public function configureAddSetter(): void
    {
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

    public function configureRemoveSetter(): void
    {
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
        $format .= '%3$s$index = array_search(%2$s, $this->%4$s);' . "\n";
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

    public function getSingleMethodName(?string $prefix = null, ?string $suffix = null): string
    {
        return $this->getMethodName($prefix, $suffix);
    }

    public function getSingleTypes(): array
    {
        $phpSingleTypes = [];

        foreach ($this->property->getTypes() as $type) {
            if (preg_match('#\[]$#', $type)) {
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
