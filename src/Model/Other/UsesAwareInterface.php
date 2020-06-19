<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

interface UsesAwareInterface
{
    public function getUses(): UsesInterface;

    public function setUses(UsesInterface $uses): void;
}
