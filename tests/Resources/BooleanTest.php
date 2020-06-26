<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Boolean type test class
 * @internal
 */
final class BooleanTest
{
    /** @var bool */
    private $aBoolField = false;

    /**
     * @return bool
     */
    public function isABoolField(): bool
    {
        return $this->aBoolField;
    }

    /**
     * @param bool $aBoolField
     */
    public function setABoolField(bool $aBoolField): void
    {
        $this->aBoolField = $aBoolField;
    }
}
