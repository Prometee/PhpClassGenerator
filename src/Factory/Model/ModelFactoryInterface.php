<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model;

interface ModelFactoryInterface
{
    public function getModelClass(): string;

    public function setModelClass(string $modelClass): void;
}
