<?php

declare(strict_types=1);

namespace Tests\Dummy;

use DateTimeInterface;
use stdClass;
use Tests\Dummy\AFolder\Foo as FooAlias;

/**
 * Test class
 *
 * @internal
 */
class Foo extends stdClass
{
    /**
     * My array field description
     * with line break
     *
     * @var FooAlias[]|null
     */
    private $anArrayOfItems;

    /**
     * My array field description
     *
     * @var array|null
     */
    private $aSimpleArrayField;

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
     * My float field description
     *
     * @var float
     */
    private $aFloatField = 0.0;

    /**
     * My integer field description
     *
     * @var int
     */
    private $aIntegerField = 0;

    /**
     * My mixed field description
     *
     * @var mixed|null
     */
    private $aMixedField;

    /**
     * My date time field description
     *
     * @var DateTimeInterface|null
     */
    private $aDateTimeField;

    /**
     * @return FooAlias[]|null
     */
    public function getAnArrayOfItems(): ?array
    {
        return $this->anArrayOfItems;
    }

    /**
     * @return string
     */
    public function getAStringField(): string
    {
        return $this->aStringField;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getADateTimeField(): ?DateTimeInterface
    {
        return $this->aDateTimeField;
    }

    /**
     * @param mixed|null $aMixedField
     */
    public function setAMixedField($aMixedField): void
    {
        $this->aMixedField = $aMixedField;
    }

    /**
     * @return mixed|null
     */
    public function getAMixedField()
    {
        return $this->aMixedField;
    }

    /**
     * @param int $aIntegerField
     */
    public function setAIntegerField(int $aIntegerField): void
    {
        $this->aIntegerField = $aIntegerField;
    }

    /**
     * @return int
     */
    public function getAIntegerField(): int
    {
        return $this->aIntegerField;
    }

    /**
     * @param float $aFloatField
     */
    public function setAFloatField(float $aFloatField): void
    {
        $this->aFloatField = $aFloatField;
    }

    /**
     * @return float
     */
    public function getAFloatField(): float
    {
        return $this->aFloatField;
    }

    /**
     * @param string $aStringField
     */
    public function setAStringField(string $aStringField): void
    {
        $this->aStringField = $aStringField;
    }

    /**
     * @param bool $aBoolField
     */
    public function setABoolField(bool $aBoolField): void
    {
        $this->aBoolField = $aBoolField;
    }

    /**
     * @param FooAlias[]|null $anArrayOfItems
     */
    public function setAnArrayOfItems(?array $anArrayOfItems): void
    {
        $this->anArrayOfItems = $anArrayOfItems;
    }

    /**
     * @return bool
     */
    public function isABoolField(): bool
    {
        return $this->aBoolField;
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
     * @param bool $strict
     *
     * @return bool
     */
    public function hasASimpleArrayField($item, bool $strict = true): bool
    {
        return in_array($item, $this->aSimpleArrayField, $strict);
    }

    /**
     * @param array|null $aSimpleArrayField
     */
    public function setASimpleArrayField(?array $aSimpleArrayField): void
    {
        $this->aSimpleArrayField = $aSimpleArrayField;
    }

    /**
     * @return array|null
     */
    public function getASimpleArrayField(): ?array
    {
        return $this->aSimpleArrayField;
    }

    /**
     * @param FooAlias $item
     */
    public function removeAnArrayOfItems(FooAlias $item): void
    {
        if ($this->hasAnArrayOfItems($item)) {
            $index = array_search($item, $this->anArrayOfItems);
            unset($this->anArrayOfItems[$index]);
        }
    }

    /**
     * @param FooAlias $item
     */
    public function addAnArrayOfItems(FooAlias $item): void
    {
        if ($this->hasAnArrayOfItems($item)) {
            return;
        }

        $this->anArrayOfItems[] = $item;
    }

    /**
     * @param FooAlias $item
     * @param bool $strict
     *
     * @return bool
     */
    public function hasAnArrayOfItems(FooAlias $item, bool $strict = true): bool
    {
        return in_array($item, $this->anArrayOfItems, $strict);
    }

    /**
     * @param DateTimeInterface|null $aDateTimeField
     */
    public function setADateTimeField(?DateTimeInterface $aDateTimeField): void
    {
        $this->aDateTimeField = $aDateTimeField;
    }
}
