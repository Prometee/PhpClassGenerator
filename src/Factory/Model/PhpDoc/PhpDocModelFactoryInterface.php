<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\PhpDoc;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

interface PhpDocModelFactoryInterface extends ModelFactoryInterface
{
    public function create(): PhpDocInterface;
}
