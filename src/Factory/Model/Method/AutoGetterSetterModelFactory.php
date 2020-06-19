<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class AutoGetterSetterModelFactory extends AbstractModelFactory implements AutoGetterSetterModelFactoryInterface
{
    /** @var ArrayGetterSetterModelFactoryInterface */
    private $arrayGetterSetterModelFactory;
    /** @var IsserSetterModelFactoryInterface */
    private $isserSetterModelFactory;
    /** @var GetterSetterModelFactoryInterface */
    private $getterSetterModelFactory;

    public function __construct(
        string $modelClass,
        ArrayGetterSetterModelFactoryInterface $arrayGetterSetterModelFactory,
        IsserSetterModelFactoryInterface $isserSetterModelFactory,
        GetterSetterModelFactoryInterface $getterSetterModelFactory
    ) {
        parent::__construct($modelClass);
        $this->arrayGetterSetterModelFactory = $arrayGetterSetterModelFactory;
        $this->isserSetterModelFactory = $isserSetterModelFactory;
        $this->getterSetterModelFactory = $getterSetterModelFactory;
    }

    public function create(UsesInterface $uses): AutoGetterSetterInterface
    {
        return new $this->modelClass([
            $this->arrayGetterSetterModelFactory->create($uses),
            $this->isserSetterModelFactory->create($uses),
            $this->getterSetterModelFactory->create($uses),
        ]);
    }
}
