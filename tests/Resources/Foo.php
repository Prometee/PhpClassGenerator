<?php

declare(strict_types=1);

namespace Tests\Dummy;

use DateTimeInterface;
use stdClass;
use Tests\Dummy\AFolder\Foo as FooAlias;

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
     * @return float
     */
    public function getAFloatField(): float
    {
        return $this->aFloatField;
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
     * @param string $aStringField
     */
    public function setAStringField(string $aStringField): void
    {
        $this->aStringField = $aStringField;
    }

    /**
     * @param FooAlias[]|null $anArrayOfItems
     */
    public function setAnArrayOfItems(?array $anArrayOfItems): void
    {
        $this->anArrayOfItems = $anArrayOfItems;
    }

    /**
     * @return string
     */
    public function getAStringField(): string
    {
        return $this->aStringField;
    }

    /**
     * @param bool $aBoolField
     */
    public function setABoolField(bool $aBoolField): void
    {
        $this->aBoolField = $aBoolField;
    }

    /**
     * @return bool
     */
    public function isABoolField(): bool
    {
        return $this->aBoolField;
    }

    /**
     * @param FooAlias $anArrayOfItems
     */
    public function removeAnArrayOfItems(FooAlias $anArrayOfItems): void
    {
        if ($this->hasAnArrayOfItems($anArrayOfItems)) {
            $index = array_search($anArrayOfItems, $this->anArrayOfItems);
            unset($this->anArrayOfItems[$index]);
        }
    }

    /**
     * @param FooAlias $anArrayOfItems
     */
    public function addAnArrayOfItems(FooAlias $anArrayOfItems): void
    {
        if ($this->hasAnArrayOfItems($anArrayOfItems)) {
            return;
        }

        $this->anArrayOfItems[] = $anArrayOfItems;
    }

    /**
     * @param FooAlias $anArrayOfItems
     * @param bool $strict
     *
     * @return bool
     */
    public function hasAnArrayOfItems(FooAlias $anArrayOfItems, bool $strict = true): bool
    {
        return in_array($anArrayOfItems, $this->anArrayOfItems, $strict);
    }

    /**
     * @param DateTimeInterface|null $aDateTimeField
     */
    public function setADateTimeField(?DateTimeInterface $aDateTimeField): void
    {
        $this->aDateTimeField = $aDateTimeField;
    }
}
