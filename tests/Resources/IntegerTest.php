<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Integer type test class
 *
 * @internal
 */
final class IntegerTest
{
    private int $anIntegerField = 0;

    public function getAnIntegerField(): int
    {
        return $this->anIntegerField;
    }

    public function setAnIntegerField(int $anIntegerField): void
    {
        $this->anIntegerField = $anIntegerField;
    }
}
