<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use stdClass;

/**
 * Php base class type test class
 *
 * @internal
 */
final class PhpBaseClassTest
{
    private ?stdClass $aStdClassField = null;

    public function getAStdClassField(): ?stdClass
    {
        return $this->aStdClassField;
    }

    public function setAStdClassField(?stdClass $aStdClassField): void
    {
        $this->aStdClassField = $aStdClassField;
    }
}
