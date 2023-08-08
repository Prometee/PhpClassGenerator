<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

class Constructor extends Method implements ConstructorInterface
{
    protected string $scope = self::SCOPE_PUBLIC;
    
    protected string $name = '__construct';

    public function configure(
        string $scope,
        string $name,
        array $returnTypes = [],
        bool $static = false,
        string $description = ''
    ): void {
        parent::configure(self::SCOPE_PUBLIC, '__construct', $returnTypes, $static, $description);
    }
}
