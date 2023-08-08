<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use Tests\Prometee\PhpClassGenerator\Resources\SubPath\SubClassTest;

/**
 * Config with sub class type test class
 *
 * @internal
 */
final class ConfigWithSubPathTest
{
    public function __construct(private SubClassTest $aSubClassField)
    {
    }

    public function getASubClassField(): SubClassTest
    {
        return $this->aSubClassField;
    }

    public function setASubClassField(SubClassTest $aSubClassField): void
    {
        $this->aSubClassField = $aSubClassField;
    }
}
