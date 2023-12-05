<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;

/** @property class-string<AttributeInterface> $modelClass */
final class AttributeModelFactory extends AbstractModelFactory implements AttributeModelFactoryInterface
{
    public function create(): AttributeInterface
    {
        return new $this->modelClass();
    }
}
