<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class PropertiesModelFactory extends AbstractModelFactory implements PropertiesModelFactoryInterface
{
    public function create(UsesInterface $uses): PropertiesInterface
    {
        return new $this->modelClass($uses);
    }
}
