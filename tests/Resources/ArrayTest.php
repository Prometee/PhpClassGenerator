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
     *
     * @return bool
     */
    public function hasAnArrayOfItems(ArrayTestAlias $item): bool
    {
        if (null === $this->anArrayOfItems) {
            return false;
        }

        return in_array($item, $this->anArrayOfItems);
    }

    /**
     * @param ArrayTestAlias $item
     */
    public function addAnArrayOfItems(ArrayTestAlias $item): void
    {
        if ($this->hasAnArrayOfItems($item)) {
            return;
        }

        if (null === $this->anArrayOfItems) {
            $this->anArrayOfItems = [];
        }

        $this->anArrayOfItems[] = $item;
    }

    /**
     * @param ArrayTestAlias $item
     */
    public function removeAnArrayOfItems(ArrayTestAlias $item): void
    {
        if (null === $this->anArrayOfItems) {
            $this->anArrayOfItems = [];
        }

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
     *
     * @return bool
     */
    public function hasASimpleArrayField($item): bool
    {
        if (null === $this->aSimpleArrayField) {
            return false;
        }

        return in_array($item, $this->aSimpleArrayField);
    }

    /**
     * @param mixed $item
     */
    public function addASimpleArrayField($item): void
    {
        if ($this->hasASimpleArrayField($item)) {
            return;
        }

        if (null === $this->aSimpleArrayField) {
            $this->aSimpleArrayField = [];
        }

        $this->aSimpleArrayField[] = $item;
    }

    /**
     * @param mixed $item
     */
    public function removeASimpleArrayField($item): void
    {
        if (null === $this->aSimpleArrayField) {
            $this->aSimpleArrayField = [];
        }

        if ($this->hasASimpleArrayField($item)) {
            $index = array_search($item, $this->aSimpleArrayField);
            unset($this->aSimpleArrayField[$index]);
        }
    }
}
