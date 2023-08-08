<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use DateTimeInterface;

/**
 * Php base Interface type test class
 *
 * @internal
 */
final class PhpBaseInterfaceTest
{
    private ?DateTimeInterface $aDateTimeField = null;

    public function getADateTimeField(): ?DateTimeInterface
    {
        return $this->aDateTimeField;
    }

    public function setADateTimeField(?DateTimeInterface $aDateTimeField): void
    {
        $this->aDateTimeField = $aDateTimeField;
    }
}
