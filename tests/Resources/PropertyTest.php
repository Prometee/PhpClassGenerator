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

    /**
     * A simple array var
     */
    private array $aSimpleArrayField = [];

    public function __construct(
        /**
         * A boolean var
         */
        private bool $aBoolean,
        /**
         * Another boolean var
         */
        private bool $anotherBoolean
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

    public function getASimpleArrayField(): array
    {
        return $this->aSimpleArrayField;
    }

    public function setASimpleArrayField(array $aSimpleArrayField): void
    {
        $this->aSimpleArrayField = $aSimpleArrayField;
    }

    public function hasASimpleArrayField(mixed $item): bool
    {
        return in_array($item, $this->aSimpleArrayField, true);
    }

    public function addASimpleArrayField(mixed $item): void
    {
        if ($this->hasASimpleArrayField($item)) {
            return;
        }

        $this->aSimpleArrayField[] = $item;
    }

    public function removeASimpleArrayField(mixed $item): void
    {
        if ($this->hasASimpleArrayField($item)) {
            $index = array_search($item, $this->aSimpleArrayField, true);
            unset($this->aSimpleArrayField[$index]);
        }
    }

    public function isABoolean(): bool
    {
        return $this->aBoolean;
    }

    public function setABoolean(bool $aBoolean): void
    {
        $this->aBoolean = $aBoolean;
    }

    public function isAnotherBoolean(): bool
    {
        return $this->anotherBoolean;
    }

    public function setAnotherBoolean(bool $anotherBoolean): void
    {
        $this->anotherBoolean = $anotherBoolean;
    }
}
