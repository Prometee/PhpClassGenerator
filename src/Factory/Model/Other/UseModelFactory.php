<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\UseModelInterface;

final class UseModelFactory extends AbstractModelFactory implements UseModelFactoryInterface
{
    public function create(): UseModelInterface
    {
        return new $this->modelClass();
    }
}
