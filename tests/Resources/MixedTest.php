<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

/**
 * Mixed type test class
 * @internal
 */
final class MixedTest
{
    /** @var mixed|null */
    private $aMixedField;

    /**
     * @return mixed|null
     */
    public function getAMixedField()
    {
        return $this->aMixedField;
    }

    /**
     * @param mixed|null $aMixedField
     */
    public function setAMixedField($aMixedField): void
    {
        $this->aMixedField = $aMixedField;
    }
}
