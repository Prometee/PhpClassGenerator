<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface ModelFactoryInterface
{
    public function getModelClass(): string;

    /** @param class-string<ModelInterface> $modelClass */
    public function setModelClass(string $modelClass): void;
}
