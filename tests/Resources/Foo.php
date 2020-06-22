<?php

declare(strict_types=1);

namespace Tests\Dummy;

use stdClass;

final class Foo extends stdClass
{
    /**
     * My array field description
     * with line break
     *
     * @var Foo[]|null
     */
    private $anArrayOfItems;

    /**
     * My bool field description
     *
     * @var bool
     */
    private $aBoolField = false;

    /**
     * My string field description
     *
     * @var string
     */
    private $aStringField = '';

    /**
     * @return Foo[]|null
     */
    public function getAnArrayOfItems(): ?array
    {
        return $this->anArrayOfItems;
    }

    /**
     * @param Foo[]|null $anArrayOfItems
     */
    public function setAnArrayOfItems(?array $anArrayOfItems): void
    {
        $this->anArrayOfItems = $anArrayOfItems;
    }

    /**
     * @param Foo $anArrayOfItems
     * @param bool $strict
     *
     * @return bool
     */
    public function hasAnArrayOfItems(Foo $anArrayOfItems, bool $strict = true): bool
    {
        return in_array($anArrayOfItems, $this->anArrayOfItems, $strict);
    }

    /**
     * @param Foo $anArrayOfItems
     */
    public function addAnArrayOfItems(Foo $anArrayOfItems): void
    {
        if ($this->hasAnArrayOfItems($anArrayOfItems)) {
            return;
        }

        $this->anArrayOfItems[] = $anArrayOfItems;
    }

    /**
     * @param Foo $anArrayOfItems
     */
    public function removeAnArrayOfItems(Foo $anArrayOfItems): void
    {
        if ($this->hasAnArrayOfItems($anArrayOfItems)) {
            $index = array_search($anArrayOfItems, $this->anArrayOfItems);
            unset($this->anArrayOfItems[$index]);
        }
    }

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

    /**
     * @return string
     */
    public function getAStringField(): string
    {
        return $this->aStringField;
    }

    /**
     * @param string $aStringField
     */
    public function setAStringField(string $aStringField): void
    {
        $this->aStringField = $aStringField;
    }
}
