<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface AttributeViewAwareInterface
{
    public function configureAttribute(AttributeInterface $attribute, UsesInterface $uses): void;
}
