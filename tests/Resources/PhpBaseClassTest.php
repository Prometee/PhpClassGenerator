<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use stdClass;

/**
 * Php base class type test class
 * @internal
 */
final class PhpBaseClassTest
{
    /** @var stdClass|null */
    private $aStdClassField;

    /**
     * @return stdClass|null
     */
    public function getAStdClassField(): ?stdClass
    {
        return $this->aStdClassField;
    }

    /**
     * @param stdClass|null $aStdClassField
     */
    public function setAStdClassField(?stdClass $aStdClassField): void
    {
        $this->aStdClassField = $aStdClassField;
    }
}
