<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Property;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

/** @property class-string<PropertyInterface> $modelClass */
final class PropertyModelFactory extends AbstractModelFactory implements PropertyModelFactoryInterface
{
    /**
     * @param class-string<PropertyInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected PhpDocModelFactoryInterface $phpDocModelFactory
    ) {
        parent::__construct($modelClass);
    }

    public function create(UsesInterface $uses): PropertyInterface
    {
        return new $this->modelClass(
            $uses,
            $this->phpDocModelFactory->create()
        );
    }

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        return $this->phpDocModelFactory;
    }
}
