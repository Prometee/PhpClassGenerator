<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * String type test class
 * @internal
 */
final class StringTest
{
    /** @var string */
    private $aStringField = '';

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
