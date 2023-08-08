<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<MethodInterface> $modelClass */
final class MethodModelFactory extends AbstractModelFactory implements MethodModelFactoryInterface
{
    /**
     * @param class-string<MethodInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected PhpDocModelFactoryInterface $phpDocModelFactory
    ) {
        parent::__construct($modelClass);
    }

    public function create(UsesInterface $uses): MethodInterface
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
