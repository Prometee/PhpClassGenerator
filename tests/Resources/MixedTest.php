<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Mixed type test class
 * @internal
 */
final class MixedTest
{
    /** @var mixed|null */
    private $aMixedField;

    /** @var int|string */
    private $anOtherMixedField;

    /** @var int|string|null */
    private $anOtherMixedFieldWithNull;

    /** @var self[]|array */
    private $anOtherMixedFieldWithArray;

    /**
     * @param int|string $anOtherMixedField
     * @param self[]|array $anOtherMixedFieldWithArray
     */
    public function __construct($anOtherMixedField, array $anOtherMixedFieldWithArray)
    {
        $this->anOtherMixedField = $anOtherMixedField;
        $this->anOtherMixedFieldWithArray = $anOtherMixedFieldWithArray;
    }

    /**
     * @return mixed|null
     */
    public function getAMixedField()
    {
        return $this->aMixedField;
    }

    /**
     * @param mixed|null $aMixedField
     */
    public function setAMixedField($aMixedField): void
    {
        $this->aMixedField = $aMixedField;
    }

    /**
     * @return int|string
     */
    public function getAnOtherMixedField()
    {
        return $this->anOtherMixedField;
    }

    /**
     * @param int|string $anOtherMixedField
     */
    public function setAnOtherMixedField($anOtherMixedField): void
    {
        $this->anOtherMixedField = $anOtherMixedField;
    }

    /**
     * @return int|string|null
     */
    public function getAnOtherMixedFieldWithNull()
    {
        return $this->anOtherMixedFieldWithNull;
    }

    /**
     * @param int|string|null $anOtherMixedFieldWithNull
     */
    public function setAnOtherMixedFieldWithNull($anOtherMixedFieldWithNull): void
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
     * @param bool $strict
     *
     * @return bool
     */
    public function hasAnOtherMixedFieldWithArray($item, bool $strict = true): bool
    {
        return in_array($item, $this->anOtherMixedFieldWithArray, $strict);
    }

    /**
     * @param self|mixed $item
     */
    public function addAnOtherMixedFieldWithArray($item): void
    {
        if ($this->hasAnOtherMixedFieldWithArray($item)) {
            return;
        }

        $this->anOtherMixedFieldWithArray[] = $item;
    }

    /**
     * @param self|mixed $item
     */
    public function removeAnOtherMixedFieldWithArray($item): void
    {
        if ($this->hasAnOtherMixedFieldWithArray($item)) {
            $index = array_search($item, $this->anOtherMixedFieldWithArray);
            unset($this->anOtherMixedFieldWithArray[$index]);
        }
    }
}
