<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface UsesAwareInterface extends ModelInterface
{
    public function getUses(): UsesInterface;

    public function setUses(UsesInterface $uses): void;
}
