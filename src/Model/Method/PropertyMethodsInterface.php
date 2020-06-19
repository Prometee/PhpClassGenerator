<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;

interface PropertyMethodsInterface extends UsesAwareInterface
{
    public function configure(PropertyInterface $property): void;

    /**
     * @param string|null $indent
     *
     * @return MethodInterface[]
     */
    public function getMethods(string $indent = null): array;
}
