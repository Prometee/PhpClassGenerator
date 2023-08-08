<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * String type test class
 *
 * @internal
 */
final class StringTest
{
    private string $aStringField = '';

    public function getAStringField(): string
    {
        return $this->aStringField;
    }

    public function setAStringField(string $aStringField): void
    {
        $this->aStringField = $aStringField;
    }
}
