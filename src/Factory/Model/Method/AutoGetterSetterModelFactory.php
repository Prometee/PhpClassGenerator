<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<AutoGetterSetterInterface> $modelClass */
final class AutoGetterSetterModelFactory extends AbstractModelFactory implements AutoGetterSetterModelFactoryInterface
{
    /**
     * @param class-string<AutoGetterSetterInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        private ArrayGetterSetterModelFactoryInterface $arrayGetterSetterModelFactory,
        private IsserSetterModelFactoryInterface $isserSetterModelFactory,
        private GetterSetterModelFactoryInterface $getterSetterModelFactory
    ) {
        parent::__construct($modelClass);
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
