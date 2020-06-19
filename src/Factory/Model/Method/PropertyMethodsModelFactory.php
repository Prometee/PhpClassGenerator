<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Method\PropertyMethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class PropertyMethodsModelFactory extends AbstractModelFactory implements PropertyMethodsModelFactoryInterface
{
    /** @var IsserSetterModelFactoryInterface */
    private $isserSetterModelFactory;
    /** @var GetterSetterModelFactoryInterface */
    private $getterSetterModelFactory;

    public function __construct(
        string $modelClass,
        IsserSetterModelFactoryInterface $isserSetterModelFactory,
        GetterSetterModelFactoryInterface $getterSetterModelFactory
    ) {
        parent::__construct($modelClass);
        $this->isserSetterModelFactory = $isserSetterModelFactory;
        $this->getterSetterModelFactory = $getterSetterModelFactory;
    }

    public function create(UsesInterface $uses): PropertyMethodsInterface
    {
        return new $this->modelClass(
            $uses,
            $this->isserSetterModelFactory,
            $this->getterSetterModelFactory
        );
    }
}
