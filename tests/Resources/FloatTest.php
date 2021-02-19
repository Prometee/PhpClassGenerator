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
    /** @var float */
    private $aFloatField = .0;

    /**
     * @return float
     */
    public function getAFloatField(): float
    {
        return $this->aFloatField;
    }

    /**
     * @param float $aFloatField
     */
    public function setAFloatField(float $aFloatField): void
    {
        $this->aFloatField = $aFloatField;
    }
}
