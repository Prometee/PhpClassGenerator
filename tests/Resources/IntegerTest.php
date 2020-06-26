<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Integer type test class
 * @internal
 */
final class IntegerTest
{
    /** @var int */
    private $anIntegerField = 0;

    /**
     * @return int
     */
    public function getAnIntegerField(): int
    {
        return $this->anIntegerField;
    }

    /**
     * @param int $anIntegerField
     */
    public function setAnIntegerField(int $anIntegerField): void
    {
        $this->anIntegerField = $anIntegerField;
    }
}
