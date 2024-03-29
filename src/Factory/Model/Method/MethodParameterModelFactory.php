<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Attribute\AttributeModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<MethodParameterInterface> $modelClass */
final class MethodParameterModelFactory extends AbstractModelFactory implements MethodParameterModelFactoryInterface
{
    /**
     * @param class-string<MethodParameterInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        private PhpDocModelFactoryInterface $phpDocModelFactory,
        private AttributeModelFactoryInterface $attributeModelFactory,
    ) {
        parent::__construct($modelClass);
    }

    public function create(UsesInterface $uses): MethodParameterInterface
    {
        return new $this->modelClass(
            $uses,
            $this->phpDocModelFactory->create(),
            $this->attributeModelFactory->create(),
        );
    }

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        return $this->phpDocModelFactory;
    }

    public function getAttributeModelFactory(): AttributeModelFactoryInterface
    {
        return $this->attributeModelFactory;
    }
}
