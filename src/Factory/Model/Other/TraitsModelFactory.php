<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<TraitsInterface> $modelClass */
final class TraitsModelFactory extends AbstractModelFactory implements TraitsModelFactoryInterface
{
    public function create(UsesInterface $uses): TraitsInterface
    {
        return new $this->modelClass($uses);
    }
}
