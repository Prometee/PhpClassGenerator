<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Property;

class Constant extends Property implements ConstantInterface
{
    protected string $scope = 'public const';

    public function getPhpName(): string
    {
        return strtoupper($this->name);
    }

    public function getValue(): ?string
    {
        $value = parent::getValue();
        // Always assign to something
        if (null === $value) {
            return 'null';
        }

        return $value;
    }

    public function getPhpTypeFromTypes(): string
    {
        return '';
    }
}
