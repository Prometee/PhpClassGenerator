<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\ClassModel\TraitClassInterface;

interface TraitClassModelFactoryInterface extends ModelFactoryInterface
{
    public function create(): TraitClassInterface;
}
