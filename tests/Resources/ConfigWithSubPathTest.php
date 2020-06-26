<?php

declare(strict_types=1);

namespace Tests\Prometee\PhpClassGenerator\Resources;

use Tests\Prometee\PhpClassGenerator\Resources\SubPath\SubClassTest;

/**
 * Config with sub class type test class
 * @internal
 */
final class ConfigWithSubPathTest
{
    /** @var SubClassTest */
    private $aSubClassField;

    /**
     * @param SubClassTest $aSubClassField
     */
    public function __construct(SubClassTest $aSubClassField)
    {
        $this->aSubClassField = $aSubClassField;
    }

    /**
     * @return SubClassTest
     */
    public function getASubClassField(): SubClassTest
    {
        return $this->aSubClassField;
    }

    /**
     * @param SubClassTest $aSubClassField
     */
    public function setASubClassField(SubClassTest $aSubClassField): void
    {
        $this->aSubClassField = $aSubClassField;
    }
}
