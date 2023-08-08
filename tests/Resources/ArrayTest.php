<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use Tests\Prometee\PhpClassGenerator\Resources\ArrayTest as ArrayTestAlias;

/**
 * Array type test class
 *
 * @internal
 */
final class ArrayTest
{
    /** @var ArrayTestAlias[]|null */
    private ?array $anArrayOfItems = null;

    private ?array $aSimpleArrayField = null;

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

    public function hasAnArrayOfItems(ArrayTestAlias $item): bool
    {
        if (null === $this->anArrayOfItems) {
            return false;
        }

        return in_array($item, $this->anArrayOfItems, true);
    }

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

    public function removeAnArrayOfItems(ArrayTestAlias $item): void
    {
        if (null === $this->anArrayOfItems) {
            $this->anArrayOfItems = [];
        }

        if ($this->hasAnArrayOfItems($item)) {
            $index = array_search($item, $this->anArrayOfItems, true);
            unset($this->anArrayOfItems[$index]);
        }
    }

    public function getASimpleArrayField(): ?array
    {
        return $this->aSimpleArrayField;
    }

    public function setASimpleArrayField(?array $aSimpleArrayField): void
    {
        $this->aSimpleArrayField = $aSimpleArrayField;
    }

    public function hasASimpleArrayField(mixed $item): bool
    {
        if (null === $this->aSimpleArrayField) {
            return false;
        }

        return in_array($item, $this->aSimpleArrayField, true);
    }

    public function addASimpleArrayField(mixed $item): void
    {
        if ($this->hasASimpleArrayField($item)) {
            return;
        }

        if (null === $this->aSimpleArrayField) {
            $this->aSimpleArrayField = [];
        }

        $this->aSimpleArrayField[] = $item;
    }

    public function removeASimpleArrayField(mixed $item): void
    {
        if (null === $this->aSimpleArrayField) {
            $this->aSimpleArrayField = [];
        }

        if ($this->hasASimpleArrayField($item)) {
            $index = array_search($item, $this->aSimpleArrayField, true);
            unset($this->aSimpleArrayField[$index]);
        }
    }
}
