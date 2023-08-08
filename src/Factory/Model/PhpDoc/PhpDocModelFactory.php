<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\PhpDoc;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;

/** @property class-string<PhpDocInterface> $modelClass */
final class PhpDocModelFactory extends AbstractModelFactory implements PhpDocModelFactoryInterface
{
    public function create(): PhpDocInterface
    {
        return new $this->modelClass();
    }
}
