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
    /** @var DateTimeInterface|null */
    private $aDateTimeField;

    /**
     * @return DateTimeInterface|null
     */
    public function getADateTimeField(): ?DateTimeInterface
    {
        return $this->aDateTimeField;
    }

    /**
     * @param DateTimeInterface|null $aDateTimeField
     */
    public function setADateTimeField(?DateTimeInterface $aDateTimeField): void
    {
        $this->aDateTimeField = $aDateTimeField;
    }
}
