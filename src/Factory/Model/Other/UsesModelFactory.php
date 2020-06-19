<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class UsesModelFactory extends AbstractModelFactory implements UsesModelFactoryInterface
{
    public function create(): UsesInterface
    {
        return new $this->modelClass();
    }
}
