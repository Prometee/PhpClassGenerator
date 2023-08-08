<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Property test class
 *
 * @internal
 */
final class PropertyTest
{
    /**
     * A string var
     */
    public string $aString = 'test_property_value';

    public function __construct(
        /**
         * A boolean var
         */
        private bool $aBoolean
    ) {
    }

    public function getAString(): string
    {
        return $this->aString;
    }

    public function setAString(string $aString): void
    {
        $this->aString = $aString;
    }

    public function isABoolean(): bool
    {
        return $this->aBoolean;
    }

    public function setABoolean(bool $aBoolean): void
    {
        $this->aBoolean = $aBoolean;
    }
}
