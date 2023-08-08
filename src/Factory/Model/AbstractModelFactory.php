<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model;

use Prometee\PhpClassGenerator\Model\ModelInterface;

abstract class AbstractModelFactory implements ModelFactoryInterface
{
    public function __construct(
        /** @var class-string<ModelInterface> */
        protected string $modelClass,
    ) {
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    public function setModelClass(string $modelClass): void
    {
        $this->modelClass = $modelClass;
    }
}
