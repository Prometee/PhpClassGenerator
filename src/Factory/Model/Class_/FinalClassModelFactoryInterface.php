<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\FinalClassInterface;

interface FinalClassModelFactoryInterface extends ModelFactoryInterface
{
    public function create(): FinalClassInterface;
}
