<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use Tests\Prometee\PhpClassGenerator\Resources\ArrayTest as ArrayTestAlias;

/**
 * Array type test class
 * @internal
 */
final class ArrayTest
{
    /** @var ArrayTestAlias[]|null */
    private $anArrayOfItems;

    /** @var array|null */
    private $aSimpleArrayField;

    /**
     * @return ArrayTestAlias[]|null
     */
    public function getAnArrayOfItems(): ?array
    {
        return $this->anArrayOfItems;
    }

    /**
     * @param ArrayTestAlias[]|null $anArrayOfItems
     */
    public function setAnArrayOfItems(?array $anArrayOfItems): void
    {
        $this->anArrayOfItems = $anArrayOfItems;
    }

    /**
     * @param ArrayTestAlias $item
     * @param bool $strict
     *
     * @return bool
     */
    public function hasAnArrayOfItems(ArrayTestAlias $item, bool $strict = true): bool
    {
        return in_array($item, $this->anArrayOfItems, $strict);
    }

    /**
     * @param ArrayTestAlias $item
     */
    public function addAnArrayOfItems(ArrayTestAlias $item): void
    {
        if ($this->hasAnArrayOfItems($item)) {
            return;
        }

        $this->anArrayOfItems[] = $item;
    }

    /**
     * @param ArrayTestAlias $item
     */
    public function removeAnArrayOfItems(ArrayTestAlias $item): void
    {
        if ($this->hasAnArrayOfItems($item)) {
            $index = array_search($item, $this->anArrayOfItems);
            unset($this->anArrayOfItems[$index]);
        }
    }

    /**
     * @return array|null
     */
    public function getASimpleArrayField(): ?array
    {
        return $this->aSimpleArrayField;
    }

    /**
     * @param array|null $aSimpleArrayField
     */
    public function setASimpleArrayField(?array $aSimpleArrayField): void
    {
        $this->aSimpleArrayField = $aSimpleArrayField;
    }

    /**
     * @param mixed $item
     * @param bool $strict
     *
     * @return bool
     */
    public function hasASimpleArrayField($item, bool $strict = true): bool
    {
        return in_array($item, $this->aSimpleArrayField, $strict);
    }

    /**
     * @param mixed $item
     */
    public function addASimpleArrayField($item): void
    {
        if ($this->hasASimpleArrayField($item)) {
            return;
        }

        $this->aSimpleArrayField[] = $item;
    }

    /**
     * @param mixed $item
     */
    public function removeASimpleArrayField($item): void
    {
        if ($this->hasASimpleArrayField($item)) {
            $index = array_search($item, $this->aSimpleArrayField);
            unset($this->aSimpleArrayField[$index]);
        }
    }
}