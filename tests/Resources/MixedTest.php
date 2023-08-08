<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Mixed type test class
 *
 * @internal
 */
final class MixedTest
{
    /** @var mixed|null */
    private mixed $aMixedField = null;

    private int|string|null $anOtherMixedFieldWithNull = null;

    public function __construct(
        private int|string $anOtherMixedField,
        /** @var self[]|array */
        private array $anOtherMixedFieldWithArray
    ) {
    }

    /**
     * @return mixed|null
     */
    public function getAMixedField(): mixed
    {
        return $this->aMixedField;
    }

    /**
     * @param mixed|null $aMixedField
     */
    public function setAMixedField(mixed $aMixedField): void
    {
        $this->aMixedField = $aMixedField;
    }

    public function getAnOtherMixedField(): int|string
    {
        return $this->anOtherMixedField;
    }

    public function setAnOtherMixedField(int|string $anOtherMixedField): void
    {
        $this->anOtherMixedField = $anOtherMixedField;
    }

    public function getAnOtherMixedFieldWithNull(): int|string|null
    {
        return $this->anOtherMixedFieldWithNull;
    }

    public function setAnOtherMixedFieldWithNull(int|string|null $anOtherMixedFieldWithNull): void
    {
        $this->anOtherMixedFieldWithNull = $anOtherMixedFieldWithNull;
    }

    /**
     * @return self[]|array
     */
    public function getAnOtherMixedFieldWithArray(): array
    {
        return $this->anOtherMixedFieldWithArray;
    }

    /**
     * @param self[]|array $anOtherMixedFieldWithArray
     */
    public function setAnOtherMixedFieldWithArray(array $anOtherMixedFieldWithArray): void
    {
        $this->anOtherMixedFieldWithArray = $anOtherMixedFieldWithArray;
    }

    /**
     * @param self|mixed $item
     */
    public function hasAnOtherMixedFieldWithArray(mixed $item): bool
    {
        return in_array($item, $this->anOtherMixedFieldWithArray, true);
    }

    /**
     * @param self|mixed $item
     */
    public function addAnOtherMixedFieldWithArray(mixed $item): void
    {
        if ($this->hasAnOtherMixedFieldWithArray($item)) {
            return;
        }

        $this->anOtherMixedFieldWithArray[] = $item;
    }

    /**
     * @param self|mixed $item
     */
    public function removeAnOtherMixedFieldWithArray(mixed $item): void
    {
        if ($this->hasAnOtherMixedFieldWithArray($item)) {
            $index = array_search($item, $this->anOtherMixedFieldWithArray, true);
            unset($this->anOtherMixedFieldWithArray[$index]);
        }
    }
}
