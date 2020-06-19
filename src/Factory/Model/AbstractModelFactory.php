<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model;

abstract class AbstractModelFactory implements ModelFactoryInterface
{
    /** @var string */
    protected $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
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
