<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Boolean type test class
 *
 * @internal
 */
final class BooleanTest
{
    private bool $aBoolField = false;

    public function isABoolField(): bool
    {
        return $this->aBoolField;
    }

    public function setABoolField(bool $aBoolField): void
    {
        $this->aBoolField = $aBoolField;
    }
}
