<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Attribute;

class Constant extends Property implements ConstantInterface
{
    protected $scope = 'public const';

    public function getPhpName(): string
    {
        return strtoupper($this->name);
    }
}
