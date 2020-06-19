<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

class Constructor extends Method implements ConstructorInterface
{
    protected $scope = self::SCOPE_PUBLIC;
    
    protected $name = '__construct';

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
