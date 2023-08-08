<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Float type test class
 *
 * @internal
 */
final class FloatTest
{
    private float $aFloatField = .0;

    public function getAFloatField(): float
    {
        return $this->aFloatField;
    }

    public function setAFloatField(float $aFloatField): void
    {
        $this->aFloatField = $aFloatField;
    }
}
